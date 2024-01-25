<template>
    <button id="addNewTaskBtn" @click="openNewTaskDialog"><img src="/img/add-to-list.png" alt="Add to list"></button>
    
    <newTask :class="newTaskDialogClass"></newTask>
    
    <div v-if="userTasks.length !== 0" class="container">
        <span class="todoSpan">TO DO LIST</span>
        
        <div id="taskListDiv">
            <table>
                <thead>
                    <tr>
                        <th class="dateSort" @click="sortByDate()">Date &#9650; &#9660;</th>
                        <th>Task</th>
                        <th>Status</th>
                        <th>Set Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <taskList v-for="task in temporaryTasks"
                        :id="task.id"
                        :title="task.title"
                        :status="task.status"
                        :date="task.created_at">
                    </taskList>
                </tbody>
            </table>
        </div>
    </div>
    <div v-else> NO TASK </div>
    <div id="trashDiv" :class="trashDialogClass">
        <div v-if="deletedTasks.length !== 0">
            <span class="trashSpan"> TRASH </span>
            <table>
                <thead>
                    <tr>
                        <th> Date </th>
                        <th> Title </th>
                    </tr>
                </thead>
                <tbody v-for="task in deletedTasks">
                    <trash 
                    :id="task.id" 
                    :title="task.title" 
                    :date="task.created_at"></trash>
                </tbody>
            </table>
        </div>
        <div v-else> Trash is Empty </div>
    </div>
    <div id="trashAndLogoutBtnDiv">
        <form action="">
            <label for="searchTitle"> Search Title </label>
            <input name="searchTitle" v-model.trim="formData.title">
        </form>
        <button id="searchBtn"  @click="searchTitle"><img src="/img/search-glass.png" alt="Trash"></button>
        <button id="trashBtn" @click="openTrashTaskDialog"><img src="/img/trash-can.png" alt="Trash"></button>
        <button id="logoutBtn" @click="logout"> <img src="/img/logout.png" alt="Logout"> </button>
    </div>
</template>

<script>
import newTask from './newTask.vue';
import taskList from './tasksList.vue';
import trash from './taskTrash.vue';

export default {
    emits: ['sign-out'],
    components: {
        newTask,
        taskList,
        trash
    },
    props: {
        userData: {
            required: true,
            type: Object,
            validator: (value) => {
                return value.id !== undefined && typeof value.id === 'number' &&
                    value.email_address !== undefined && typeof value.email_address === 'string'
                    && value.tasks !== undefined;
            }
        },
        axiosInstance: {
            type: Function,
            required: true
        },
        logout: {
            type: Function,
            required: true
        }
    },
    data() {
        return {
            temporaryTasks: {},
            userTasks: {},
            deletedTasks : {},
            newTaskDialogClass : '',
            trashDialogClass: '',
            sort: 'desc',
            isUpdate: false,
            formData:{
                title: '',
                user_id: this.userData.id
            }
        };
    },
    watch: {
        'userData' : {
            handler() {
               this.segregateTasks();
               this.sortByDate();
            },
            deep: true
        }
    },
    methods: {
        openNewTaskDialog() {
            this.newTaskDialogClass = this.newTaskDialogClass !== 'slide-left' ? 'slide-left' : 'slide-right';
        },
        openTrashTaskDialog() {
            this.trashDialogClass = this.trashDialogClass !== 'slide-left' ? 'slide-left' : 'slide-right';
        },
        sortByDate() {
            this.temporaryTasks = this.temporaryTasks.sort((prevValue, nextValue) => {
                const prevValueDate = new Date(prevValue.created_at);
                const nextValueDate = new Date(nextValue.created_at);
                if (this.sort === 'desc') {
                    return prevValueDate - nextValueDate;
                }
                return nextValueDate - prevValueDate;
            });
            this.sort = this.sort === 'desc' ? 'asc' : 'desc'; 
        },
        segregateTasks() {
            this.deletedTasks = this.userData.tasks.filter(task => {
                return task.status === 'deleted';
            })
            
            this.userTasks = this.userData.tasks.filter(task => {
                return task.status != 'deleted';
            })

            this.temporaryTasks = this.userTasks;
        },
        async searchTitle()
        {
            if (this.formData.title === '') {
                return this.temporaryTasks = this.userTasks;
            }
            await this.axiosInstance.post('/search', this.formData)
                .then((response) => {
                    if (response.data === undefined || response.data.data === null) {
                        alert('No Task Found');
                        if (this.temporaryTasks !== this.userTasks) {
                            this.temporaryTasks = this.userTasks;
                        }
                    }
                    this.temporaryTasks = response.data.data;
                    this.formData.title = '';
                }).catch((error) => {
                    alert(error);
                });
        }
    },
    beforeMount() {
        this.segregateTasks();
    }
}
</script>


<style scoped>

#trashDiv {
    border: none !important;
    position: absolute;
    top: 10rem;
    right: -30rem;
    border: 1px solid;
    padding: 10px;
    z-index: 10;
    background-color: rgb(255, 230, 209);
    max-height: 400px;
    width: 300px;
    overflow-x: scroll;
    border-top-left-radius: 20px;
    border-bottom-left-radius: 20px;
    overflow-x: hidden;
    text-align: center;
}

.trashSpan {
    font-size: 25px;
}

#trashDiv > table {
    margin-top:20%;
}
.container {
    display: flex;
    align-content: center;
    justify-content: space-evenly;
    align-items: flex-end;
    flex-direction: column;
}

#taskListDiv {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: auto;
    display: flex;
    flex-direction: column;
    max-height: 548px;
    overflow-y: scroll;
}

.todoSpan {
    position: absolute;
    top: 13%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 50px;
}

th {
    font-size: 18px;
    padding-top: 20px;
    padding-bottom: 10px;
    /* border: 0.5px solid rgba(199, 48, 2, 0.582); */
    background-color: rgba(199, 48, 2, 0.4);
    margin: auto;
}

th:last-child{
    border-top-right-radius: 10px;
}

th:first-child {
    border-top-left-radius: 10px;
}

.dateSort {
    cursor: pointer;
}

table {
    border-collapse: collapse;
    width: 100%;
}

#addNewTaskBtn {
    position: absolute;
    bottom: 2%;
    right:2%;
    border: none;
    z-index: 10;
    background-color: white;
    width: 50px;
    height: 50px;
    background-color: whitesmoke;
    cursor: pointer;
}

#addNewTaskBtn > img {
    width: 50px;
    height: 50px;
}

#trashBtn, #searchBtn, #logoutBtn {
    border: none;
    z-index: 10;
    background-color: white;
    width: 30px;
    height: 30px;
    background-color: whitesmoke;
    cursor: pointer;
    margin: 5px;
}

#trashBtn > img, #searchBtn>img, #logoutBtn > img {
    width: 30px;
    height: 30px;
}


#trashAndLogoutBtnDiv {
    top: 2%;
    right: 2%;
    position: absolute;
    width: auto;
    display: flex;
    flex-direction: row;
    align-items: center;
}

@media (max-width: 1669px) {
    #taskListDiv {
        max-height: 548px;
    }
}

@media (max-width: 1511px) {
    #taskListDiv {
        max-height: 548px;
    }
}

@media (max-width: 1064px) {
    #taskListDiv {
        max-height: 548px;
    }
}

@media (max-width: 768px) {
    #taskListDiv {
        max-height: 548px;
    }
}

@media (max-width: 658px) {
    #taskListDiv {
        max-height: 548px;
    }
}

@media (max-width: 585px) {
    #taskListDiv {
        max-height: 548px;
    }
}

@media (max-height: 925px) {
    #taskListDiv {
        max-height: 500px;
    }
}

@media (max-height: 832px) {
    #taskListDiv {
        max-height: 440px;
    }
}

@media (max-height: 768px) {
    #taskListDiv {
        max-height: 380px;
    }
}

</style>