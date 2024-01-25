<template>
    <tr>
        <td>
            <div class="date">
                <span > {{ new Date(date).toLocaleDateString() }}</span>
            </div>
        </td>
        <td>
            <div class="taskTitleDiv">
                <span class="taskTitle" :class="status"> {{ title }}</span>
            </div>
        </td>
        <td>
            <div class="taskStatusDiv">
                <span class="taskStatus" :class="'task' + status"> {{ setStatusLabelDisplayText(status) }}</span>
            </div>
        </td>
        <td>
            <button v-if="status !== 'to_do'" @click="setStatus('to_do', id)" class="todoBtn" value="to_do"> TD </button>
            <button v-if="status !== 'in_progress'" @click="setStatus('in_progress', id)" class="inProgBtn" value="in_progress"> IP </button>
            <button v-if="status !== 'completed'" @click="setStatus('completed', id)" class="completedBtn" value="completed"> C </button>
        </td>
        <td>
            <button @click="setStatus('deleted', id)" class="deleteBtn" :id="id"> Del </button>
        </td>
    </tr>
</template>

<script>
    export default {
        inject: ['setStatus'],
        props: {
            id : {
                required : true,
                type     : Number
            },
            title: {
                required : true,
                type: String
            },
            status: {
                required : true,
                type: String
            },
            date: {
                required : true,
                type: String
            }
        },
        methods:{
            setStatusLabelDisplayText(status) {
                return status === 'to_do' ? 'To Do' : status === 'in_progress' ? 'In Progress' : 'Completed';
            }
        }
    }
</script>

<style scoped>

.completed {
    text-decoration: line-through;
}

button {
    margin-left: 2px;
    margin-right: 2px;
}
.todoBtn {
    font-size: 12px;
    font-weight: bold;
    background-color: rgb(79, 161, 255);
    color:white;
    border-radius: 4px;
    border:none;
    width: 30px;
    height: 20px;
    cursor: pointer;
}

.todoBtn:active {
    background-color: rgb(47, 90, 139);
}

.inProgBtn {
    font-size: 12px;
    font-weight: bold;
    background-color: rgb(201, 197, 0);
    color:white;
    border-radius: 4px;
    border:none;
    width: 30px;
    height: 20px;
    cursor: pointer;
}

.inProgBtn:active {
    background-color: rgb(128, 125, 0);
}

.completedBtn {
    font-size: 12px;
    font-weight: bold;
    background-color: rgb(68, 168, 47);
    color:white;
    border-radius: 4px;
    border:none;
    width: 30px;
    height: 20px;
    cursor: pointer;
}

.completedBtn:active {
    background-color: rgb(48, 117, 34);
}

.taskto_do {
    color : rgb(79, 161, 255);
}

.taskin_progress {
    color : rgb(201, 197, 0);
}

.taskcompleted {
    color : rgb(68, 168, 47);
}

.taskTitle {
    font-size: 20px;
    font-weight: bold;
}

.taskStatus{
    font-size: 15px;
    font-weight: bold;
}

.deleteBtn {
    font-size: 12px;
    font-weight: bold;
    background-color: rgb(61, 13, 13);
    color:white;
    border-radius: 4px;
    border:none;
    width: 30px;
    height: 20px;
    cursor: pointer;
}

.deleteBtn:active {
    background-color: rgb(141, 29, 29);
}

.updateBtn {
    font-size: 12px;
    font-weight: bold;
    background-color: rgb(168, 50, 192);
    color:white;
    border-radius: 4px;
    border:none;
    width: 40px;
    height: 20px;
}

.updateBtn:active {
    background-color: rgb(88, 18, 97);
}

@media (max-width:1545px) {
    button {
        margin-bottom: 2px;
    }
    
}

</style>
