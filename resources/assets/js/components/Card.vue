<script>
    export default {
        props: ['card'],
        mounted() {
            console.log(this.card.name + " added");
        },
        updated() {
            jQuery(".list--cards").sortable("refresh");
        }
    }
</script>
