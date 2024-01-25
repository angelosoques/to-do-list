<template>
    <div v-if="isLoggedIn">
        <taskApp
        :userData="userData"
        :axiosInstance="axiosInstance"
        :logout="logout"
        ></taskApp>
    </div>
        
    <div v-else id="authDiv">
        <table id="authTable">
            <tbody>
                <tr>
                    <td>
                        <div>
                            <registration 
                                :axiosInstance="axiosInstance"
                                @receive-new-user="handleLoggedInUserData"
                            ></registration>
                        </div>
                    </td>
                    <td>
                        <div>
                            <login 
                                :axiosInstance="axiosInstance" 
                                @user-logged="handleLoggedInUserData"
                            ></login>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios';
import login from './users/login.vue';
import registration from './users/registration.vue';
import taskApp from './tasks/taskApp.vue';

    export default{
        components: {
            login,
            registration,
            taskApp,
        },
        data() {
            return {
                isLoggedIn: false, 
                axiosInstance: axios.create({
                    headers: {
                        'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').content,
                    }
                }),
                userData : {
                    id : null,
                    email_address : '',
                    tasks : []
                },
            }
        },
        provide() {
            return {
                axiosInstance: this.axiosInstance,
                setStatus: this.setStatus,
                createNewTask: this.createNewTask
            }
        },
        methods: {
            handleLoggedInUserData(userData) {
                this.userData.id = userData.data.id;
                this.userData.email_address = userData.data.email_address;
                this.userData.tasks = (userData.data.tasks === undefined) ? [] : userData.data.tasks;
                this.isLoggedIn = true;
            },
            async checkLoggedUser() {
                await this.axiosInstance.get('/checkLogin')
                .then((response) => {
                    if (response.data.length !== 0) {
                        this.handleLoggedInUserData(response.data);
                    }
                }).catch((error) => {
                    alert(error);
                });
            },
            async createNewTask(title) {
                let formData = {
                    title : title,
                    status : 'to_do',
                    user_id : this.userData.id
                }
                await this.axiosInstance.post(`/task/create`, formData)
                    .then((response) => {
                        if (response.data !== null) {
                            this.userData.tasks.unshift(response.data.data);
                        }
                    })
                    .catch((error) => {
                        alert(error);
                    });
            },
            setStatus(status, id) {
                let formData = {
                    status : status
                }
                this.axiosInstance.post(`/task/update/${id}`, formData)
                    .then((response) =>{
                        if (response.data !== null) {
                            this.updateTaskStatus(status, id);
                        }
                    }).catch((error) => {
                        alert(error);
                    });
            },
            updateTaskStatus(status, id)
            {
                let taskIndex = this.userData.tasks.findIndex(task => {
                    return task.id === id;
                });
                this.userData.tasks[taskIndex].status = status;
            },
            logout() {
                this.axiosInstance.get('/logout')
                .then(() => {
                    this.isLoggedIn = false;
                });
        },
        },
        beforeMount() {
            this.checkLoggedUser();
        }
    }

</script>


<style>

#authDiv {
    height: 100%;
}

#authTable {
    width: 100%;
    height: 100%;
}

#authTable td {
    width: 50%;
    text-align: center;
    border: 1px solid #ddd;
    padding: 20px;
    box-sizing: border-box;
}

#authTable td div {
    
}


body{
    overflow-x: hidden;
    background-color: whitesmoke;
    height: 100%;
}

tr {
    width: auto;
    padding:10px;
}

td {
    width: auto;
    text-align: center;
    padding:5px 20px 5px 20px;
    border:1px solid;
}

@-webkit-keyframes slide-left {
    from{right:-30rem}
    to{right:1rem}
}

@-webkit-keyframes slide-right {
    from{right:1rem}
    to{right:-30rem}
}

@keyframes slide-right {
    from{right:1rem}
    to{right:-30rem}
}

@keyframes slide-left {
    from{right:-30rem}
    to{right:1rem}
}

.slide-right {
    right:-30rem;
    -webkit-animation: slide-right 0.5s linear forwards;
    animation: slide-right 0.5s linear forwards;
}

.slide-left {
    right:1rem;
    -webkit-animation: slide-left 0.5s linear forwards;
    animation: slide-left 0.5s linear forwards;
}
</style>