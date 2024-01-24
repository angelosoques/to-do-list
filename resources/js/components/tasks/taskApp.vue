<template>
    <h1>TO DO LIST</h1>
    <newTask></newTask>
    <taskList></taskList>
    <trash></trash>
    <button @click="logout"> Logout </button>
</template>

<script>
import newTask from './newTask.vue';
import taskList from './tasksList.vue';
import trash from './taskTrash.vue';

    export default {
    components: {
        newTask,
        taskList,
        trash
    },
    provide() {
        return {
            axiosInstance: this.axiosInstance
        };
    },
    props: {
        userData: {
            required: true,
            type: Object,
            validator: (value) => {
                return value.id !== undefined && typeof value.id === 'number' &&
                    value.email_address !== undefined && typeof value.email_address === 'string';
            }
        },
        axiosInstance: {
            type: Function,
            required: true
        },
    },
    data() {
        return {
            userTasks: {},
        };
    },
    methods: {
        logout() {
            this.axiosInstance.get('/logout');
        }
    },
}
</script>