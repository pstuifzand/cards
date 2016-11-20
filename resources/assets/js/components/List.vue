<template>
    <div class="list" :data-id="list.id">
        <div class="list--name">{{ list.name }}</div>
        <div class="list--cards connected">
            <template v-for="card in list.cards">
                <div class="card" :data-id="card.id">
                    <div class="card--name">{{ card.position }} - {{ card.name }}</div>
                </div>
            </template>
            <div class="list--add-card">
                <div v-show="adding"><input v-model="newCardText" @keyup.esc="doneAdding" @keyup.enter="addCard" id="card-input" /></div>
                <div v-show="!adding" @click="startAdding">Add a card...</div>
            </div>
        </div>
    </div>
</template>

<style>
.list {
    margin-bottom: 20px;
}
.card {
    overflow: hidden;
    white-space: normal;
}
</style>

<script>
    export default {
        props: ['list'],

        data() {
            return {
                'adding': false,
                'newCardText': ''
            };
        },

        methods: {
            startAdding() {
                this.adding = true;
                this.$nextTick(function() {
                    jQuery('#card-input').focus();
                });
            },
            doneAdding() {
                this.adding = false;
            },
            addCard() {
                var name = this.newCardText;
                this.list.cards.push({'name': name});
                this.newCardText = '';
                var url = '/api/lists/' + this.list.id + '/cards';
                var that = this;
                this.$http.post(url, { 'name': name }).then(response => {
                    that.list = response.data;
                });
            },
        }
    }
</script>
