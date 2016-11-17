<template>
    <div>
        <div class="lists" v-for="list in lists">
            <card-list :list="list"></card-list>
        </div>
    </div>
</template>

<style>
.list--add-card input {
    width: 100%;
}
</style>

<script>
    export default {
        data() {
            return {
                'lists': [],
            }
        },

        mounted() {
            this.prepareComponent();
        },

        watch: {
            lists: {
                handler() {
                    this.$nextTick(function() {
                        jQuery(".lists").sortable("refresh");
                        jQuery(".list--cards").sortable("refresh");
                    });
                },
                deep: true
            }
        },

        methods: {
            prepareComponent() {

                var that = this;
                this.$http.get('/api/lists').then(response => {
                    this.lists = response.data;

                    this.$nextTick(function() {
                        $('.lists').sortable({
                            placeholder: "list-highlight"
                        });
                        jQuery('.list--cards').sortable({
                            placeholder: "ui-state-highlight",
                            connectWith: '.connected'
                        });
                        jQuery('.list--cards').on('sortupdate', function(event, ui) {
                            var cardId = ui.item.data('id');
                            if (ui.sender) {
                                var prevListId = ui.sender.parents('.list').data('id');
                                var listId = ui.item.parents('.list').data('id');
                                var position = ui.item.prevAll('.card').length;
                                that.$http.post(
                                    '/api/lists/'+prevListId+'/cards/'+cardId+'/move',
                                    { 'position': position, 'new_list_id': listId }
                                );
                            } else {
                                var listId = ui.item.parents('.list').data('id');
                                var prevListId = listId;
                                var position = ui.item.prevAll('.card').length;
                                that.$http.post(
                                    '/api/lists/'+prevListId+'/cards/'+cardId+'/move',
                                    { 'position': position, 'new_list_id': listId }
                                );
                            }
                        });
                    });

                });
            },
        }
    }
</script>
