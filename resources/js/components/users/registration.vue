<template>
    <div id="registrationDiv">
        <h1>Register</h1>
        <form @submit.prevent="registerUser">
            <div>
                <label for="email_address"> Email Address </label>
                <input type="text" name="email_address" id="registerEmailInput" v-model.trim="formData.email_address">
                <label for="password"> Password </label>
                <input type="password" name="password" id="registerPassInput" v-model.trim="formData.password">
            </div>
            <div>
                <button type="submit">Register</button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        emits: ['receive-new-user'],
        props: {
            axiosInstance: {
                type: Function,
                required: true
            }
        },
        data() {
            return {
                formData: {
                    email_address: '',
                    password: '',
                },
                dataSubmitted: false
            }
        },
        methods: {
            async registerUser()  {
                await this.axiosInstance.post('/register', this.formData,
                ).then((response) =>{
                    if (response.data === null) {
                        throw new exception();
                    }
                    
                    this.$emit('receive-new-user', response.data);
                }).catch((error) => {
                    alert(error);
                });       
            }
        }
    }

</script>

<style scoped>

#registrationDiv {
    display: flex;
    height: 100%;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}

button {
    font-size: 12px;
    font-weight: bold;
    background-color: rgb(66, 170, 74);
    color:white;
    border-radius: 4px;
    border:none;
    height: 25px;
    margin-top: 15px;
}

</style>