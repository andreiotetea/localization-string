<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Translations</div>
                    <div class="card-body w-100">
                        <button type="button" @click="addOrEdit=true" class="btn btn-primary">Add</button>
                        <div v-if="addOrEdit">
                            <label>Language</label>
                            <select class="m-1" v-model="translation.language_id">
                                <option v-for="language in languages" :selected="language.id==translation.language_id" :value="language.id">{{language.code}}</option>
                            </select>
                            <br />
                            <label>Key name</label>
                            <input class="m-1" type="text" v-model="translation.key_name">
                            <br />
                            <label>Key value</label>
                            <input class="m-1" type="text" v-model="translation.key_value">
                            <br />
                            <button type="button" class="btn btn-primary" @click="save(this.key)">Save</button>
                        </div>

                        <table class="table" v-if="translations!==null">
                          <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Language</th>
                              <th scope="col">Key name</th>
                              <th scope="col">Key value</th>
                              <th scope="col">Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="(translation, arrkey) in translations">
                              <td scope="row">{{translation.id}}</td>
                              <td class="col">{{translation.language_id>0 ? getLanguage(translation.language_id).code : ''}}</td>
                              <td class="col">{{translation.key_name}}</td>
                              <td class="col">{{translation.key_value}}</td>
                              <td class="col">
                                  <button type="button" class="btn btn-primary" @click="editTranslation(arrkey)">Edit</button>
                                  <button type="button" class="btn btn-danger m-1" @click="deleteTranslation(arrkey)">Delete</button>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                        <button type="button" class="btn btn-info" @click="exportAndroid()">Export Android</button>
                        <button type="button" class="btn btn-info m-1" @click="exportIos()">Export iOS</button>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                key: null,
                translationSaved: null,
                addOrEdit: false,
                translation: {},
                languages: null,
                dataExported: null,
                translations: null
            }
        },
        mounted() {
            this.getLanguages();
            this.getTranslations();
        },
        methods: {
            editTranslation(arrkey) {
                this.addOrEdit=true;
                this.key = arrkey;
                this.translation = this.translations[arrkey];
            },
            getLanguage(language_id) {
                return this.languages.filter((language) => {
                    return language.id===language_id;
                })[0];
            },
            async getTranslations() {
                await axios.get('api/v1/translations').then(response => (this.translations = response.data));
            },
            async getLanguages() {
                await axios.get('api/v1/languages').then(response => (this.languages = response.data));
            },
            async save(key) {
                await axios.post('api/v1/translation', this.translation)
                    .then(response => (this.translationSaved = response.data))
                    .catch(error => {
                        this.errorMessage = error.message;
                        console.error("There was an error!", error);
                    });
                if(this.translationSaved) {
                    if(key === null) {
                        this.translations.push(this.translationSaved);
                    } else {
                        this.translations[key] = this.translationSaved;
                    }
                    this.addOrEdit = false;
                    this.translationSaved = null;
                    this.translation = {};
                }
            },
            async deleteTranslation(key) {
                await axios.delete('api/v1/translation/'+this.translations[key].id)
                    .then(response => (this.dataDeleted = true))
                    .catch(error => {
                        this.errorMessage = error.message;
                        console.error("There was an error!", error);
                    });
                if(this.dataDeleted) {
                    this.translations.splice(key, 1);
                    this.dataDeleted = null;
                }
            },
            exportAndroid() {
                let translations = [];
                this.translations.forEach((value, index) => {
                    let newValue = JSON.parse(JSON.stringify(value));
                    newValue.language_id = this.getLanguage(newValue.language_id).code;
                    translations.push(newValue);
                });
                translations = JSON.stringify(translations);
                const anchor = document.createElement('a');
                anchor.href = 'data:text/json;charset=utf-8,' + encodeURIComponent(translations);
                anchor.target = '_blank';
                anchor.download = 'translations.json';
                anchor.click();
            },
            exportIos() {
                let translations = JSON.parse(JSON.stringify(this.translations));
                const array = [Object.keys(translations[0])].concat(translations)
                let csv = array.map(it => {
                    if(it.language_id > 0) {
                        it.language_id = this.getLanguage(it.language_id).code;
                    }
                    return Object.values(it).toString()
                }).join('\n');
                const anchor = document.createElement('a');
                anchor.href = 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv);
                anchor.target = '_blank';
                anchor.download = 'translations.csv';
                anchor.click();
            },
        }
    }
</script>
