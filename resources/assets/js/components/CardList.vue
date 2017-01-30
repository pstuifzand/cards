<template>
    <div>
        <div class="form-group">
            <label for="new_list" >Add a list...</label>
            <input type="text" v-model="new_list" @keyup.enter="addList" class="form-control" id="new_list" />
        </div>

        <div class="lists">
            <card-list v-for="list in lists" :list="list"></card-list>
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
        props: ['href'],

        data() {
            return {
                'lists': [],
                'new_list': ''
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
            addList() {
                axios.post(this.href, { 'name': this.new_list }).then(response => {
                    this.lists = response.data;
                    this.new_list = '';
                });
            },

            fetchLists() {
                var that = this;

                axios.get(this.href).then(response => {
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
                            // different lists
                            var listId = ui.item.parents('.list').data('id');
                            var prevListId;
                            if (ui.sender) {
                                prevListId = ui.sender.parents('.list').data('id');
                            } else { // same list
                                prevListId = listId;
                            }
                            var position = ui.item.prevAll('.card').length;
                            axios.post(
                                '/api/lists/'+prevListId+'/cards/'+cardId+'/move',
                                { 'position': position, 'new_list_id': listId }
                            );
                        });
                    });

                });
            },

            prepareComponent() {
                this.fetchLists();
            },
        }
    }
</script>
