<template>
  <form @submit.prevent="submitForm">
    <h1>
      Mandatsübersicht <small>Schritt 3 von 8</small>
      <button type="button" class="btn btn-success" @click="addRow"><i class="fa fa-plus"></i></button>
      <button type="button" class="btn btn-danger" @click="removeRow" :disabled="models.length === 1"><i class="fa fa-minus"></i></button>
    </h1>

    <div v-for="(model, index) in models" :key="model.id" class="mandte">
      <input type="hidden" :name="`mandate[${model.id}][id]`" v-model="model.id">

      <div class="row form-group">
        <div class="col-lg-1">
          <label>Vom:</label>
          <select :name="`mandate[${model.id}][fmonth]`" class="form-control" v-model="model.fmonth">
            <option v-for="m in 12" :key="m" :value="m">{{ m }}</option>
          </select>
        </div>
        <div class="col-lg-2">
          <label>Monat - Jahr</label>
          <select :name="`mandate[${model.id}][fyear]`" class="form-control" v-model="model.fyear">
            <option v-for="y in years" :key="y" :value="y">{{ y }}</option>
          </select>
        </div>
        <div class="col-lg-1">
          <label>Bis:</label>
          <select :name="`mandate[${model.id}][tmonth]`" class="form-control" v-model="model.tmonth">
            <option v-for="m in 12" :key="m" :value="m">{{ m }}</option>
          </select>
        </div>
        <div class="col-lg-2">
          <label>Monat - Jahr</label>
          <select :name="`mandate[${model.id}][tyear]`" class="form-control" v-model="model.tyear">
            <option v-for="y in years" :key="y" :value="y">{{ y }}</option>
          </select>
        </div>
        <div class="col-lg-3">
          <label>Branche</label>
          <select :name="`mandate[${model.id}][branche]`" class="form-control" v-model="model.branche" required>
            <option v-for="(name, key) in branchen" :key="key" :value="key">{{ name }}</option>
          </select>
        </div>
        <div class="col-lg-3">
          <label>Beschreibung</label>
          <textarea :name="`mandate[${model.id}][description]`" class="form-control" v-model="model.description"></textarea>
        </div>
      </div>

      <div class="row form-group">
        <div class="col-lg-3 offset-lg-6">
          <label>Umsatz</label>
          <div class="input-group">
            <input type="text" :name="`mandate[${model.id}][umsatz]`" v-model="model.umsatz" class="form-control" placeholder="Umsatz">
            <span class="input-group-text">€</span>
          </div>
        </div>
      </div>

      <div class="row form-group">
        <div class="col-lg-3 offset-lg-6">
          <label>Anzahl MA</label>
          <input type="text" :name="`mandate[${model.id}][ma]`" v-model="model.ma" class="form-control" placeholder="Anzahl MA">
        </div>
      </div>

      <div class="row form-group">
        <div class="col-lg-3 offset-lg-6">
          <label>Mitarbeiterverantwortung</label>
          <input type="text" :name="`mandate[${model.id}][worker]`" v-model="model.worker" class="form-control" placeholder="Mitarbeiterverantwortung">
        </div>
      </div>

      <div class="row form-group">
        <div class="col-lg-3 offset-lg-6">
          <label>Budget - Verantwortung</label>
          <div class="input-group">
            <input type="text" :name="`mandate[${model.id}][budget]`" v-model="model.budget" class="form-control" placeholder="Budget - Verantwortung">
            <span class="input-group-text">€</span>
          </div>
        </div>
      </div>

      <hr>
    </div>

    <div class="form-group">
      <button type="submit" class="btn btn-lg btn-primary">Speichern</button>
    </div>
  </form>
</template>

<script setup>
import { reactive } from 'vue';

const props = defineProps({
  initialModels: { type: Array, default: () => [
    { id: 1, fmonth: 1, fyear: new Date().getFullYear(), tmonth: 1, tyear: new Date().getFullYear(), branche: '', description: '', umsatz: '', ma: '', worker: '', budget: '' }
  ] },
  branchen: { type: Object, default: () => ({}) }
});

const models = reactive([...props.initialModels]);
const years = Array.from({ length: new Date().getFullYear() - 1900 + 1 }, (_, i) => new Date().getFullYear() - i);

function addRow() {
  models.push({ id: Date.now(), fmonth: 1, fyear: new Date().getFullYear(), tmonth: 1, tyear: new Date().getFullYear(), branche: '', description: '', umsatz: '', ma: '', worker: '', budget: '' });
}

function removeRow() {
  if (models.length > 1) models.pop();
}

function submitForm() {
  const formData = new FormData();
  models.forEach(m => {
    Object.keys(m).forEach(k => formData.append(`mandate[${m.id}][${k}]`, m[k]));
  });
  console.log('Submitting Mandate form', formData);
  // Send axios.post('/account/mandate', formData) here
}
</script>
