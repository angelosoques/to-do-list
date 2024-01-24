<template>
    <div>
        <form action="" @submit.prevent="createNewTask">
            <label for="newTask"> New Task </label>
            <input name="newTask" type="text" v-model="formData.newTask">
            <button type="submit"> Add New Task </button>
        </form>
    </div>
</template>


<script>
    export default {
        inject: [
            'axiosInstance'
        ],
        emits:[
            'new-task'
        ],
        data() {
            return {
                formData: {
                    newTask: '',
                    status: 'to-do'
                },
            }
        },
        methods:{
            async createNewTask() {
                this.formData.status = 'to-do';
                await this.axiosInstance.post('/task/create', this.formData)
                    .then((response) => {
                        this.$emit('new-task', response.data);
                    })
                    .catch((error) => {
                        alert(error);
                    });
            }
        }

    }

</script>