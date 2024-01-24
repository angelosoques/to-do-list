<template>
    <h1>TO DO LIST</h1>
    
</template>

<script>
    export default {
        provide() {
            return {
                axiosInstance: this.axiosInstance
            }
        },
        props: {
            userData : { 
                required: true,
                type: Object,
                validator: (value) => {
                    return value.id !== undefined && typeof value.id === 'number' &&
                           value.email_address !== undefined && typeof value.email_address === 'string';
                }
            },
            newUser : {
                required: true,
                type: Boolean
            },
            axiosInstance : Object,
        },
        data() {
            return {
                userTasks: {},
            }
        },
        beforeMount()
        {
            if (this.newUser === false) {
                async () => {
                    this.userTasks = await axiosInstance.get(`/tasks/${this.userData.id}`)
                        .then((response) => {
                            return response.data;
                        }).catch((error) => {
                            alert(error);
                        });
                }
            } 
        }
    }
</script>