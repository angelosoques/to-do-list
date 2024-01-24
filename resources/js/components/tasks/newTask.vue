<template>
    <div>
        <form action="" @submit.prevent="createNewTask">
            <label for="newTask"> New Task </label>
            <input name="newTask" type="text" v-model="formData.newTask">
        </form>
        
    </div>
</template>


<script>

    export default {
        inject: [
            'axiosInstance'
        ],
        data() {
            return {
                formData: {
                    newTask : '',
                },
            }
        },
        methods:{
            createNewTask() {
                let resultData = this.axiosInstance.post('/task/create', this.formData)
                .then((response) => {
                    return response.data;
                })
                .catch((error) => {
                    alert(error);
                });

                this.$emit('new-task', resultData);
            }
        }

    }

</script>