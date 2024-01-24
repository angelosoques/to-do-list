<template>
    <div id="loginDiv" class="container">
        <h1> Login </h1>
        <form id="loginForm" action="" @submit.prevent="attemptLogin">
            <label for="email_address"> Email Address </label>
            <input type="text" name="email_address" id="login_email_address" v-model="formData.email_address">        
            <label for="password"> Password </label>
            <input type="password" name="password" id="login_password" v-model="formData.password">
        </form>
    </div>
</template>

<script>
    export default {
        props: {
            axiosInstance : Object
        },
        emits: [
            'user-logged'
        ],
        data () {
            return {
                formData : {
                    email_address: '',
                    password: '',
                }
            }
        },
        methods: {
            async attemptLogin ()  {
                await this.axiosInstance.post('/api/login', formData)
                .then((response) => {
                    if (response.data !== undefined)
                    this.$emits('user-logged');
                }).catch((error) => {
                    alert(error);
                });
            }
        }
    }

</script>