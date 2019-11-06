<template>
<v-layout row>
    <v-flex xs3 users-list>
        <v-simple-table fixed-header height="656px">
            <template v-slot:default>
                <thead>
                    <tr>
                        <th class="text-left">Chat</th>
                    </tr>
                </thead>
                <tbody class="mr-5 ml-5">
                    <tr v-for="friend in friends"
                    class="chat-private"

                    v-bind:style="{'background-color': (friend.id == activeFriend.id) ? 'green' : ''}"

                    :key="friend.id"
                    @click="activeFriend=friend.id"
                    >
                        <td>{{ friend.name }}</td>
                    </tr>
                </tbody>
            </template>
        </v-simple-table>

    </v-flex>

    <v-flex id="privateMessageBox" class="mb-5 chat-content" xs9>
        <v-simple-table fixed-header fixed-footer height="600px">
            <template v-slot:default>
                <thead>
                    <tr>
                        <th class="text-left">
                        <td>Bùi Viết Thảo</td>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(message, index) in allMessages" :key="index">
                        <td class="text-left message-received">
                            <v-chip>
                                <v-icon>mdi-account</v-icon>
                                {{ message.message }} 
                            </v-chip>
                        </td>
                    </tr>
                </tbody>
            </template>
        </v-simple-table>
        <v-bottom-navigation>
            <v-flex xs11 enter-message>
                <v-text-field rows=2 v-model="message" placeholder="Enter Message" single-line @keyup.enter="sendMessage"></v-text-field>
            </v-flex>

            <v-flex xs1 send>
                <v-btn @click="sendMessage" dark class="mt-3 ml-2 white--text" small color="green">send</v-btn>
            </v-flex>
        </v-bottom-navigation>
    </v-flex>

    <!-- <div class="floating-div">
        <picker v-if="emoStatus" set="emojione" @select="onInput" title="Pick your emoji…" />

    </div> -->
</v-layout>
</template>

<script>
import MessageList from './_message-list';
export default {
    props: ['user'],
    components: {
        MessageList,
    },
    data() {
        return {
            message: null,
            allMessages: [],
            users: [],
            activeFriend: null,
            onlineFriends:[],
        }
    },

    computed: {
        friends(){
            return this.users.filter((user)=>{
                return user.id !==this.user.id;
            });
        }
    },

    watch: {
        activeFriend(val){
            this.fetchMessages();
        }
    },

    methods: {
        sendMessage() {
            if (!this.message) {
                return alert('please enter');
            }

            if(!this.activeFriend){
                return alert('Please select friend');
            }

            // this.allMessages.push(this.message);

            axios.post('/private-messages/'+this.activeFriend, {
                message: this.message
            }).then(response => {
                this.message = null;
                this.allMessages.push(response.data.message);
                setTimeout(this.scrollToEnd, 100);
            });
        },
        fetchMessages() {
            if(!this.activeFriend){
                return alert('Please select friend');
            }
            axios.get('/private-messages/'+this.activeFriend).then(response => {
                this.allMessages = response.data;
                setTimeout(this.scrollToEnd,100);
            });
        },
        fetchUsers(){
            axios.get('/fetchUsers').then(response => {
                this.users = response.data;
                if(this.friends.length>0){
                  this.activeFriend=this.friends[0].id;
                }
            });
        }

    },

    mounted() {
        // console.dir(this.user);
    },

    created() {
        this.fetchUsers();
        Echo.channel('privatechat'+ this.activeFriend +'_database_chatroom')
            .listen('MessageSent', (e) => {
                console.log('pmessage sent')
                this.activeFriend=e.message.user_id;
                this.allMessages.push(e.message)
                setTimeout(this.scrollToEnd, 100);
            });
    }

}
</script>

<style scoped>
/* .users-list, .chat-content {
    height: 600px;
} */

.online-users,
.messages {
    /* overflow-y: scroll;
    height: 70vh;
    border: 1px solid darkblue; */
}

.user-name-title {
    border-bottom: 1px solid darkblue;
    z-index: 100;
    position: relative;
}

.users-list div.v-data-table,
#privateMessageBox div.v-data-table,
div.enter-message,
div.send {
    border: 1px solid darkblue;
}

/* td.message-sent span{
    background-color: red;
} */
td.message-received span{
    color: blue;
}
</style>
