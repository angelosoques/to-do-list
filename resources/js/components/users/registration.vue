<template>
    <div>
        <h1>Register</h1>
        <form @submit.prevent="registerUser">
            <div>
                <label for="email_address"> Email Address </label>
                <input type="text" name="email_address" id="registerEmailInput" v-model="formData.email_address">
            </div>
            <div>
                <label for="password"> Password </label>
                <input type="password" name="password" id="registerPassInput" v-model="formData.password">
            </div>
            <div>
                <button type="submit">Register</button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        emits: [
            'user-registered'
        ],
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
                await this.axiosInstance.post('/api/register', this.formData,
                ).then((response) =>{
                    console.log(response);
                    if (response.data === undefined) {
                        throw new exception();
                    }
                    
                    this.$emit('user-registered', response.data);
                }).catch((error) => {
                    console.log(error);
                });       

                
            }
        }
    }

</script>