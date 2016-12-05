<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1 class="panel-title" v-text="title"></h1>
        </div>
        <div class="panel-body">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['title'],
    }
</script>
