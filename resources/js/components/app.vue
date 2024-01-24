<template>
    <div v-if="isLoggedIn" type="container">
        <taskApp
        :userData="userData" 
        :newUser="newUser"
        :axiosInstance="axiosInstance"
        ></taskApp>
    </div>
        
    <div v-else type="container">
        <login 
        :axiosInstance="axiosInstance" 
        ></login>
        
        <registration 
        :axiosInstance="axiosInstance" 
        @user-registered="receiveUserId"
        ></registration>
    </div>
</template>

<script>
import axios from 'axios';
import login from './users/login.vue';
import registration from './users/registration.vue';
import taskApp from './tasks/taskApp.vue';

    export default{
        components: {
            login,
            registration,
            taskApp,
        },
        data() {
            return {
                isLoggedIn: false, 
                axiosInstance: axios.create({
                    headers: {
                        'x-csrf-token' : document.querySelector('meta[name="csrf-token"]').content,
                    }
                }),
                userData : {
                    id : null,
                    email_address : '',
                },
                // userData : {
                //     userId : 1,
                //     userEmail : 'angelosoques@gmail.com',
                // },
                newUser: false,
            }
        },
        watch() {
            isLoggedIn
        },
        methods: {
            receiveUserId(userData) {
                this.userData.id = userData.id;
                this.userData.email_address = userData.email_address;
                this.newUser = true;
                this.isLoggedIn = true;
            }
        },
        beforeMount() {
            // let fetchedData = async () => {
            //     this.axiosInstance.get('/auth')
            //     .then((response) => {
            //         return response.data;
            //     }).catch({

            //     });
            // }

            // if (this.fetchedData !== null) {
            //     this.userData.userId = userId;
            //     this.userData.userEmail = userEmail;
            //     this.isLoggedIn = true;
            // }
        }
    }

</script>