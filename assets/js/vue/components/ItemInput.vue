<template>
    <div>
        <input class="form-control" v-model="name" v-on:keyup.enter="submit(name)">
    </div>
</template>

<script>
    import {itemMixin} from '../mixins/item';

    export default {
        mixins: [itemMixin],
        data: () => {return {name: null}},
        methods: {
            submit(name) {
                this.createItem(name)
                    .then(item => {
                        this.$emit('newItem', item);
                        this.name = null;
                    });
            }
        }
    };
</script>

<style scoped lang="scss">

</style>