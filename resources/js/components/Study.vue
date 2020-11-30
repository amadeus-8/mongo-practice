<template>
    <div>
        <div>
            <h4>Количество классов в школах, подключенных к Системе электронного обучения E-learning</h4>
            <div class="d-flex justify-content-center mb-3">
                <button class="btn btn-success">Добавить</button>
            </div>
            <div v-for="(study, index) in studies" class="border p-3 mb-3">
                <div><b>ID</b>: {{ study.id }}</div>
                <div><b>Количество</b>: {{ study.amt }}</div>
                <div><b>Город</b>: {{ study.region }}</div>
                <div><b>Учебное заведение</b>: {{ study.school_name }}</div>
                <div class="d-flex justify-content-end">
                    <div>
                        <button class="btn btn-danger" @click="deleteStudyData(study.id)">Удалить</button>
                        <button class="btn btn-warning" data-toggle="modal" :data-target="`#study-modal-${index}`">Обновить</button>
                    </div>
                </div>

                <!-- Modal -->
                <div>
                    <div class="modal fade" :id="`study-modal-${index}`" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Тут будет контент
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary">Сохранить изменения</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal -->
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Study",
        data() {
            return {
                studies: [],
            }
        },
        mounted() {
            this.getStudiesData();
        },
        methods: {
            getStudiesData() {
                axios.get('/api/study/get', {})
                      .then(response => {
                          if(response.data.success) {
                              this.setStudiesData(response.data);
                          }
                      })
                      .catch(error => {
                          alert(error);
                      })
            },
            setStudiesData(data) {
                this.studies = data.studies;
            },

            deleteStudyData(id) {
                alert(id);
            },

            updateStudyData(id) {
                alert(id);
            }
        }
    }
</script>

<style scoped>

</style>
