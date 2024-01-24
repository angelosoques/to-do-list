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
            axiosInstance: Object
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
                let userData = await this.axiosInstance.post('/api/register', this.formData,
                ).then((response) =>{
                    if (response.json === null) {
                        throw new exception("an error occurred.");
                    }
                    alert('Registered Successfully.');
                    return response.data;
                }).catch((error) => {
                    console.log(error);
                });       

                this.$emit('user-registered', userData);
            }
        }
    }

</script>