<template>
    <div v-if="isLoggedIn" type="container">
        <tasksApp
        :userData="userData" 
        :newUser="newUser"
        :axiosInstance="axiosInstance"
        ></tasksApp>
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
import tasksApp from './tasks/taskApp.vue';

    export default{
        components: {
            login,
            registration,
            tasksApp,
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
                    userId : null,
                    userEmail : '',
                },
                newUser: false,
            }
        },
        watch() {
            isLoggedIn
        },
        methods: {
            receiveUserId(userId, userEmail) {
                this.userData.userId = userId;
                this.userData.userEmail = userEmail;
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