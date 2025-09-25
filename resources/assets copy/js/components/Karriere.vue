<template>
  <form @submit.prevent="submitForm">
    <h1>Werdegang <small>Schritt 4 von 8</small></h1>

    <!-- Ausbildung Section -->
    <h2>
      Ausbildung
      <button type="button" class="btn btn-success" @click="addRow('ausbildung')">
        <i class="fa fa-plus"></i>
      </button>
      <button type="button" class="btn btn-danger" @click="removeRow('ausbildung')" :disabled="ausbildungen.length === 1">
        <i class="fa fa-minus"></i>
      </button>
    </h2>

    <div v-for="(ausbildung, index) in ausbildungen" :key="ausbildung.id" class="form-group">
      <input type="hidden" :name="`ausbildung[${ausbildung.id}][id]`" v-model="ausbildung.id">
      <input type="hidden" :name="`ausbildung[${ausbildung.id}][type]`" value="ausbildung">

      <div class="row form-group">
        <div class="col-lg-1">
          <label>Monat</label>
          <select :name="`ausbildung[${ausbildung.id}][fmonth]`" class="form-control" v-model="ausbildung.fmonth">
            <option v-for="m in 12" :key="m" :value="m">{{ m }}</option>
          </select>
        </div>
        <div class="col-lg-2">
          <label>Jahr</label>
          <select :name="`ausbildung[${ausbildung.id}][fyear]`" class="form-control" v-model="ausbildung.fyear">
            <option v-for="y in years" :key="y" :value="y">{{ y }}</option>
          </select>
        </div>
        <div class="col-lg-1">
          <label>Monat</label>
          <select :name="`ausbildung[${ausbildung.id}][tmonth]`" class="form-control" v-model="ausbildung.tmonth">
            <option v-for="m in 12" :key="m" :value="m">{{ m }}</option>
          </select>
        </div>
        <div class="col-lg-2">
          <label>Jahr</label>
          <select :name="`ausbildung[${ausbildung.id}][tyear]`" class="form-control" v-model="ausbildung.tyear">
            <option v-for="y in years" :key="y" :value="y">{{ y }}</option>
          </select>
        </div>
        <div class="col-lg-3">
          <label>Ausbildung nach § 4a FAO</label>
          <select :name="`ausbildung[${ausbildung.id}][fachrichtung]`" class="form-control" v-model="ausbildung.fachrichtung" required>
            <option v-for="(name, key) in fachrichtungenAusbildung" :key="key" :value="key">{{ name }}</option>
          </select>
        </div>
        <div class="col-lg-3">
          <label>Beschreibung</label>
          <textarea :name="`ausbildung[${ausbildung.id}][description]`" class="form-control" v-model="ausbildung.description"></textarea>
        </div>
      </div>

      <div class="row form-group">
        <div class="col-lg-3">
          <label>Spezialisierung</label>
          <select :name="`ausbildung[${ausbildung.id}][spezialisierung]`" class="form-control" v-model="ausbildung.spezialisierung" required>
            <option v-for="(name, key) in spezialisierungen" :key="key" :value="key">{{ name }}</option>
          </select>
        </div>
      </div>

      <hr>
    </div>

    <!-- Karriere Section -->
    <h2>
      Karriere
      <button type="button" class="btn btn-success" @click="addRow('karriere')">
        <i class="fa fa-plus"></i>
      </button>
      <button type="button" class="btn btn-danger" @click="removeRow('karriere')" :disabled="karrieren.length === 1">
        <i class="fa fa-minus"></i>
      </button>
    </h2>

    <div v-for="(karriere, index) in karrieren" :key="karriere.id" class="form-group">
      <input type="hidden" :name="`karriere[${karriere.id}][id]`" v-model="karriere.id">
      <input type="hidden" :name="`karriere[${karriere.id}][type]`" value="karriere">

      <div class="row form-group">
        <div class="col-lg-1">
          <label>Monat</label>
          <select :name="`karriere[${karriere.id}][fmonth]`" class="form-control" v-model="karriere.fmonth">
            <option v-for="m in 12" :key="m" :value="m">{{ m }}</option>
          </select>
        </div>
        <div class="col-lg-2">
          <label>Jahr</label>
          <select :name="`karriere[${karriere.id}][fyear]`" class="form-control" v-model="karriere.fyear">
            <option v-for="y in years" :key="y" :value="y">{{ y }}</option>
          </select>
        </div>
        <div class="col-lg-1">
          <label>Monat</label>
          <select :name="`karriere[${karriere.id}][tmonth]`" class="form-control" v-model="karriere.tmonth">
            <option v-for="m in 12" :key="m" :value="m">{{ m }}</option>
          </select>
        </div>
        <div class="col-lg-2">
          <label>Jahr</label>
          <select :name="`karriere[${karriere.id}][tyear]`" class="form-control" v-model="karriere.tyear">
            <option v-for="y in years" :key="y" :value="y">{{ y }}</option>
          </select>
        </div>
        <div class="col-lg-3">
          <label>Fachrichtung</label>
          <select :name="`karriere[${karriere.id}][fachrichtung]`" class="form-control" v-model="karriere.fachrichtung" required>
            <option v-for="(name, key) in fachrichtungenKarriere" :key="key" :value="key">{{ name }}</option>
          </select>
        </div>
        <div class="col-lg-3">
          <label>Beschreibung</label>
          <textarea :name="`karriere[${karriere.id}][description]`" class="form-control" v-model="karriere.description"></textarea>
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
import { reactive } from "vue";

// Props from backend
const props = defineProps({
  initialAusbildungen: { type: Array, default: () => [ { id: 1, fmonth: 1, fyear: new Date().getFullYear(), tmonth: 1, tyear: new Date().getFullYear(), fachrichtung: '', description: '', spezialisierung: '' } ] },
  initialKarrieren: { type: Array, default: () => [ { id: 1, fmonth: 1, fyear: new Date().getFullYear(), tmonth: 1, tyear: new Date().getFullYear(), fachrichtung: '', description: '' } ] },
  fachrichtungenAusbildung: { type: Object, default: () => ({}) },
  fachrichtungenKarriere: { type: Object, default: () => ({}) },
  spezialisierungen: { type: Object, default: () => ({}) },
});

const ausbildungen = reactive([...props.initialAusbildungen]);
const karrieren = reactive([...props.initialKarrieren]);

const years = Array.from({length: new Date().getFullYear() - 1900 + 1}, (_, i) => new Date().getFullYear() - i);

function addRow(type) {
  if (type === "ausbildung") {
    ausbildungen.push({ id: Date.now(), fmonth: 1, fyear: new Date().getFullYear(), tmonth: 1, tyear: new Date().getFullYear(), fachrichtung: '', description: '', spezialisierung: '' });
  } else if (type === "karriere") {
    karrieren.push({ id: Date.now(), fmonth: 1, fyear: new Date().getFullYear(), tmonth: 1, tyear: new Date().getFullYear(), fachrichtung: '', description: '' });
  }
}

function removeRow(type) {
  if (type === "ausbildung" && ausbildungen.length > 1) ausbildungen.pop();
  if (type === "karriere" && karrieren.length > 1) karrieren.pop();
}

function submitForm() {
  // You can replace with axios POST to your Laravel endpoint
  const formData = new FormData();

  ausbildungen.forEach(a => {
    Object.keys(a).forEach(k => formData.append(`ausbildung[${a.id}][${k}]`, a[k]));
  });

  karrieren.forEach(k => {
    Object.keys(k).forEach(key => formData.append(`karriere[${k.id}][${key}]`, k[key]));
  });

  console.log("Submitting form", formData);
}
</script>
