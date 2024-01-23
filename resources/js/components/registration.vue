<template>
    <div>
        <form @submit.prevent="registerUser">
            <div>
                <label for="email_address"></label>
                <input type="text" name="email_address" id="emailInput" v-model="formData.email_address">
            </div>
            <div>
                <label for="password"></label>
                <input type="password" name="password" id="passInput" v-model="formData.password">
            </div>
            <div>
                <button type="submit">Register</button>
            </div>
        </form>
    </div>
</template>

<script>

    export default {
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
            registerUser() {
                this.axiosInstance.post('/register', this.formData,
                ).then((response) =>{
                    return response.json;
                }).then({

                }).catch((error) => {
                    alert(error.message);
                });       
            }
        }
    }

</script>