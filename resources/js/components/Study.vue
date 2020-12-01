<template>
    <div>
        <div>
            <h4>Количество классов в школах, подключенных к Системе электронного обучения E-learning</h4>
            <div class="d-flex justify-content-center mb-3">
                <button class="btn btn-success" data-toggle="modal" data-target="#study-add">Добавить</button>
            </div>
            <div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Найти по названию города" v-model="city_name">
                    <div class="input-group-append">
                        <button class="btn btn-primary" @click="searchStudiesData(city_name)">Найти</button>
                    </div>
                </div>
            </div>
            <div class="border mb-3">
                <h6 class="m-0 p-2">Количество записей: {{ cnt }}</h6>
            </div>
            <div v-for="(study, index) in studies" class="card p-3 mb-3">
                <div><b>ID</b>: {{ study.id }}</div>
                <div><b>Количество</b>: {{ study.amt }}</div>
                <div><b>Город</b>: {{ study.region }}</div>
                <div><b>Учебное заведение</b>: {{ study.school_name }}</div>
                <div class="d-flex justify-content-end">
                    <div>
                        <button class="btn btn-danger" @click="deleteStudyData(study.id, index)">Удалить</button>
                        <button class="btn btn-warning" data-toggle="modal" :data-target="`#study-modal-${index}`">Обновить</button>
                    </div>
                </div>

                <!-- Modal -->
                <div>
                    <div class="modal fade" :id="`study-modal-${index}`" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Обновление данных</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Количество</span>
                                        </div>
                                        <input type="number" class="form-control" v-model="count">
                                    </div>
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Город</span>
                                        </div>
                                        <input type="text" class="form-control" v-model="city">
                                    </div>
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Учебное заведение</span>
                                        </div>
                                        <input type="text" class="form-control" v-model="university">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" @click="updateStudyData(study.id, index)">Сохранить изменения</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal -->
            </div>

            <!-- Modal for adding -->
            <div>
                <div class="modal fade" id="study-add" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Добавление данных</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Количество</span>
                                    </div>
                                    <input type="number" class="form-control" v-model="count">
                                </div>
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Город</span>
                                    </div>
                                    <input type="text" class="form-control" v-model="city">
                                </div>
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Учебное заведение</span>
                                    </div>
                                    <input type="text" class="form-control" v-model="university">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" @click="addStudiesData">Добавить</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Preloader -->
            <Preloader v-if="isLoading"></Preloader>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Study",
        data() {
            return {
                studies: [],
                isLoading: false,

                count: null,
                university: null,
                city: null,

                city_name: '',

                cnt: null,
            }
        },
        mounted() {
            this.getStudiesData();
        },
        methods: {
            getStudiesData() {
                this.setIsLoading(true);
                axios.get('/api/study/get')
                     .then(response => {
                         if(response.data.success) {
                             this.setStudiesData(response.data);
                          }
                      })
                     .catch(error => {
                         alert(error);
                      })
                     .finally(() => {
                         this.setIsLoading(false);
                      })
            },
            setStudiesData(data) {
                this.studies = data.studies;
                this.cnt = data.cnt;
            },

            deleteStudyData(id, index) {
                let url = 'api/study/' + id;

                this.studies.splice(index, 1);

                this.setIsLoading(true);
                axios.delete(url)
                     .then(response => {
                         if(response.data.success) {
                             alert(response.data.message);
                         }
                     })
                     .catch(error => {
                         alert(error);
                     })
                     .finally(() => {
                         this.setIsLoading(false);
                     })
            },

            updateStudyData(id, index) {
                let url = 'api/study/' + id;

                this.studies[index].amt = this.count;
                this.studies[index].region = this.city;
                this.studies[index].school_name = this.university;

                this.setIsLoading(true);
                axios.put(url, {
                    amt: this.count,
                    region: this.city,
                    school_name: this.university,
                }).then(response => {
                    if(response.data.success) {
                        alert(response.data.message);
                    }
                }).catch(error => {
                    alert(error);
                }).finally(() => {
                    this.setIsLoading(false);
                })
            },

            searchStudiesData(city_name) {
                let url = 'api/study/get/' + city_name;
                this.setIsLoading(true);
                axios.get(url)
                     .then(response => {
                         if(response.data.success) {
                             this.setStudiesData(response.data);
                         }
                         else {
                             alert(response.data.message);
                         }
                     })
                     .catch(error => {
                         alert(error);
                     })
                     .finally(() => {
                         this.setIsLoading(false);
                         this.city_name = '';
                     })
            },

            addStudiesData() {
                this.setIsLoading(true);
                axios.post('/api/study/create', {
                    amt: this.count,
                    region: this.city,
                    school_name: this.university
                }).then(response => {
                    if(response.data.success) {
                        this.setAddedStudiesData(response.data.studies);
                    }
                }).catch(error => {
                    alert(error);
                }).finally(() => {
                    this.setIsLoading(false);
                })
            },
            setAddedStudiesData(data) {
                this.studies.push(data);
                this.count = this.university = this.city = '';
            },

            setIsLoading(value) {
                this.isLoading = value;
            }
        }
    }
</script>

<style scoped>

</style>
