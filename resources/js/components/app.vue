<template>
    <!-- <home></home> -->
    <!-- <login></login> -->
    <registration :axiosInstance="axiosInstance"></registration>
</template>


<script>
import axios from 'axios';
import home from './home.vue';
import login from './login.vue';
import registration from './registration.vue';

    export default{
        components: {
            home,
            login,
            registration
        },
        data() {
            return {
                axiosInstance: axios.create({
                    headers: {
                        'x-csrf-token' : document.querySelector('meta[name="csrf-token"]').content,
                    }
                })
            }
        },
        // beforeMount() {
        //     checkIfLoggedIn: () => {
                
        //     }
        // }
    }

</script>