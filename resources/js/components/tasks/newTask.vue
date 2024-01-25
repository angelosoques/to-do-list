<template>
    <div id="newTaskDiv">
        <span> New Task </span>
        <form action="" @submit.prevent="createNewTask(taskTitle)">
            <div class="inputDiv">
                <label for="newTask"> Title </label>
                <input name="newTask" type="text" v-model.trim="taskTitle">
            </div>
            <div>
                <button type="submit"> Save Task </button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        inject: ['createNewTask'],
        data() {
            return {
                taskTitle:'',
            }
        },
    }

</script>


<style scoped>

#newTaskDiv {
    position: absolute;
    bottom: 5rem;
    right: -30rem;
    border: 1px solid;
    padding: 10px;
    z-index:10;
    background-color: rgb(255, 168, 219);
    border-top-left-radius: 20px;
    border-bottom-left-radius: 20px;
    height: 100px;
    width: 300px;
    border:none !important;
    text-align: center;
}

span {
    padding-top: 30px;
    font-size: 20px;
    font-weight: bold;
}

.inputDiv {
    padding: 15px;
    padding-bottom: 8px;
}

label {
    padding-right: 15px;
    font-size: 15px;
    font-weight: bold;
}

button {
    color:white;
    background-color: rgb(77, 77, 77);
    border : none;
    border-radius: 5px;
    font-size: 12px;
    font-weight: bold;
    height: 30px;
    margin-left: 155px;
}

</style>