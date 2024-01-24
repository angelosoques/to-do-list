<template>
    <div id="loginDiv" class="container">
        <h1> Login </h1>
        <form id="loginForm" action="" @submit.prevent="">
            <label for="email_address"> Email Address </label>
            <input type="text" name="email_address" id="emailInput">        
            <label for="password"> Password </label>
            <input type="password" name="password" id="passInput">
        </form>
    </div>
</template>

<script>
    export default {
        props: {
            axiosInstance : Object
        },
        emits: [

        ],
        data () {

        },
        methods: {

        }
    }

</script>