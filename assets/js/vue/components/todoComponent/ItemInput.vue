<template>
    <div>
        <input class="form-control" v-model="name" :disabled="saving" v-on:keyup.enter="submit(name)">
        <b-alert
                v-bind:variant="alertVariant"
                fade
                class="position-fixed fixed-top m-0 rounded-0 text-center"
                :show="alertCountDown"
                @dismissed="showAlert=0"
                @dismiss-count-down="countDownChanged"
        >
            {{this.alertMessage}}
        </b-alert>
    </div>
</template>

<script>
    import {itemMixin} from '../../mixins/item';
    const ALERT_SECONDS = 3;

    export default {
        mixins: [itemMixin],
        data: () => {return {name: null, saving: false, alertMessage: '', alertVariant : '', alertCountDown: 0}},
        methods: {
            submit(name) {
                this.saving = true;
                this.createItem(name)
                    .then(item => {
                        this.$emit('newItem', item);
                        this.alertMessage = 'Item Successfully Added!';
                        this.alertVariant = 'success';
                        this.alertCountDown = ALERT_SECONDS;
                        this.name = null;
                    })
                    .catch(response => {
                        this.alertMessage = 'Something went wrong!';
                        this.alertVariant = 'danger';
                        this.alertCountDown = ALERT_SECONDS;
                    })
                    .finally(()  => this.saving = false);
            },
            countDownChanged(dismissCountDown) {
                this.alertCountDown = dismissCountDown;
            },
        }
    };
</script>

<style scoped lang="scss">

</style>