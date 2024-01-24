<template>
    <div v-if="isLoggedIn" type="container">
        <taskApp
        :userData="userData"
        :axiosInstance="axiosInstance"
        ></taskApp>
    </div>
        
    <div v-else type="container">
        <login 
        :axiosInstance="axiosInstance" 
        @user-logged="handleLoggedInUserData"
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
                        'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').content,
                    }
                }),
                userData : {
                    id : null,
                    email_address : '',
                    tasks : []
                },
            }
        },
        watch() {
            isLoggedIn
        },
        methods: {
            receiveUserId(userData) {
                this.userData.id = userData.id;
                this.userData.email_address = userData.email_address;
                this.isLoggedIn = true;
            },
            handleLoggedInUserData(userData) {
                this.userData.id = userData.data.id;
                this.userData.email_address = userData.data.email_address;
                this.userData.tasks = userData.data.tasks;
                this.isLoggedIn = true;
            },
            async checkLoggedUser() {
                let loggedUserData = await this.axiosInstance.get('/checkLogin')
                .then((response) => {
                    return response.data;
                }).catch((error) => {
                    alert(error);
                });

                if (loggedUserData.length !== 0) {
                    this.userData.id = loggedUserData.data.id;
                    this.userData.email_address = loggedUserData.data.email_address;
                    this.userData.tasks = loggedUserData.data.tasks;
                    this.isLoggedIn = true;
                }
            }    
        },
        beforeMount() {
            this.axiosInstance.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').content;
            this.checkLoggedUser();
        }
    }

</script>