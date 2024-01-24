<template>
    <div id="loginDiv" class="container">
        <h1> Login </h1>
        <form id="loginForm" action="" @submit.prevent="attemptLogin">
            <label for="email_address"> Email Address </label>
            <input type="text" name="email_address" id="login_email_address" v-model="formData.email_address">        
            <label for="password"> Password </label>
            <input type="password" name="password" id="login_password" v-model="formData.password">
            <button type="submit"> Login </button>
        </form>
    </div>
</template>

<script>
    export default {
        props: {
            axiosInstance : {
                type: Function,
                required : true,
            }
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
            async attemptLogin()  {
                await this.axiosInstance.post('/login', this.formData)
                .then((response) => {
                    if (response.data === undefined) {
                        throw new exception("error");
                    }
                    
                    this.$emit('user-logged', response.data);
                }).catch((error) => {
                    alert(error);
                });
            }
        }
    }

</script>