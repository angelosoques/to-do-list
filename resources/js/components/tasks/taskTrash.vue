<template>
    <tr>
        <td> {{ new Date(date).toLocaleDateString() }} </td>
        <td> {{ title }}</td>
    </tr>
</template>


<script>

    export default {
        props: {
            id : {
                type: Number,
                required: true,
            },
            title: {
                type : String,
                required: true
            },
            date: {
                type: String,
                required: true
            }
        }
    }

</script>