<template>
    <div class="mt-3 rounded shadow-sm">
        <div class="input-group mb-5">
                <input
                    type="text"
                    placeholder="task name"
                    class="form-control form-control-lg task-name-input"
                    v-model="item.name"
                />

            <button
                class="btn btn-white btn-primary"
                :disabled="item.name === ''"
                @click="addItem()"
            >
                <i class="fas fa-plus"></i> add new task
            </button>

        </div>
    </div>

</template>

<script>
export default {
    data: function() {
        return {
            item: {
                name: ""
            }
        };
    },
    methods: {
        addItem() {
            if (this.item.name === "") {
                return;
            }
            axios
                .post("api/task/store", {
                    item: this.item

                })
                .then(res => {
                    if (res.status == 201) {

                        this.item.name = "";
                        this.$emit("reloadlist");
                    }
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
};
</script>

<style scoped>

</style>
