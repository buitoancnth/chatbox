<template>

<v-layout row>
    <v-flex xs12 sm6 offset-sm3>
        <v-card class="chat-card">
            <v-list>
                <v-subheader>
                    Group Chat
                </v-subheader>
                <v-divider></v-divider>

                <message-list :user="user" :all-messages="allMessages"></message-list>
            </v-list>
        </v-card>

    </v-flex>

    <!-- <div class="floating-div">
        <picker v-if="emoStatus" set="emojione" @select="onInput" title="Pick your emoji…" />

    </div> -->

    <v-footer height="auto" fixed color="grey">
        <v-layout row>
            <!-- <v-flex class="ml-2 text-right" xs1>
                <v-btn @click="toggleEmo" fab dark small color="pink">
                    <v-icon>insert_emoticon </v-icon>
                </v-btn>
            </v-flex> -->

            <!-- <v-flex xs1 class="text-center">
                <file-upload post-action="/messages" ref='upload' @input-file="$refs.upload.active = true" :headers="{'X-CSRF-TOKEN': token}">
                    <v-icon class="mt-3">attach_file</v-icon>
                </file-upload>

            </v-flex> -->
            <v-flex xs6>
                <v-text-field rows=2 v-model="message" label="Enter Message" single-line @keyup.enter="sendMessage"></v-text-field>
            </v-flex>

            <v-flex xs4>
                <v-btn @click="sendMessage" dark class="mt-3 ml-2 white--text" small color="green">send</v-btn>

            </v-flex>

        </v-layout>

    </v-footer>
</v-layout>
</template>

<script>
window.Echo.channel('chatbox_database_chatroom')
    .listen('MessageSent', (e) => {
        console.log(e);
    });
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
        }
    },

    methods: {
        sendMessage() {
            if (!this.message) {
                return alert('please enter');
            }

            // this.allMessages.push(this.message);

            axios.post('/messages', {message: this.message}).then(response => {
                this.message = null;
                this.allMessages.push(response.data.message);
                setTimeout(this.scrollToEnd,100);
            });
        },
        fetchMessages() {
            axios.get('/messages').then(response => {
                this.allMessages = response.data;
            });
        }

    },

    mounted(){
        // console.dir(this.user);
    },

    created(){
        this.fetchMessages();
        Echo.channel('chatbox_database_chatroom')
        .listen('MessageSent',(e)=>{
            console.log(e)
            this.allMessages.push(e.message)
            setTimeout(this.scrollToEnd,100);
        });
    }

}
</script>

<style scoped>
.online-users,
.messages {
    overflow-y: scroll;
    height: 100vh;
}
</style>
