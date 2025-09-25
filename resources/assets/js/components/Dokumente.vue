<template>
  <form @submit.prevent="submitForm" enctype="multipart/form-data">
    <h1>Dokumente <small>Schritt 8 von 8</small></h1>

    <!-- Lebenslauf -->
    <h2>Lebenslauf</h2>
    <div class="form-group row">
      <div class="col-lg-3">
        <input type="file" @change="handleFile($event, 'lebenslauf')" class="form-control">
      </div>
      <div class="col-lg-3" v-if="lebenslauf">
        Lebenslauf vorhanden: {{ lebenslauf.original_file_name }} vom {{ formatDate(lebenslauf.created_at) }}
      </div>
    </div>
    <hr>

    <!-- Qualifikationen -->
    <h2 class="button-align-4">
      Qualifikationen
      <button type="button" class="btn btn-success" @click="addRow('qualifikation')">
        <i class="fa fa-plus"></i>
      </button>
      <button type="button" class="btn btn-danger" @click="removeRow('qualifikation')" :disabled="qualifikation.length === 1">
        <i class="fa fa-minus"></i>
      </button>
    </h2>

    <div v-for="(qlk, index) in qualifikation" :key="index" class="form-group row">
      <div class="col-lg-3">
        <input type="file" @change="handleFile($event, 'qualifikation', index)" class="form-control">
      </div>
    </div>

    <hr>

    <!-- Auszeichnungen -->
    <h2 class="button-align-4">
      Auszeichnungen
      <button type="button" class="btn btn-success" @click="addRow('auszeichnung')">
        <i class="fa fa-plus"></i>
      </button>
      <button type="button" class="btn btn-danger" @click="removeRow('auszeichnung')" :disabled="auszeichnung.length === 1">
        <i class="fa fa-minus"></i>
      </button>
    </h2>

    <div v-for="(az, index) in auszeichnung" :key="index" class="form-group row">
      <div class="col-lg-3">
        <input type="file" @change="handleFile($event, 'auszeichnung', index)" class="form-control">
      </div>
    </div>

    <hr>

    <!-- Sonstiges -->
    <h2 class="button-align-4">
      Sonstiges
      <button type="button" class="btn btn-success" @click="addRow('sonstiges')">
        <i class="fa fa-plus"></i>
      </button>
      <button type="button" class="btn btn-danger" @click="removeRow('sonstiges')" :disabled="sonstiges.length === 1">
        <i class="fa fa-minus"></i>
      </button>
    </h2>

    <div v-for="(s, index) in sonstiges" :key="index" class="form-group row">
      <div class="col-lg-3">
        <input type="file" @change="handleFile($event, 'sonstiges', index)" class="form-control">
      </div>
    </div>

    <hr>

    <div class="form-group">
      <button type="submit" class="btn btn-lg btn-primary">Speichern</button>
    </div>
  </form>
</template>

<script setup>
import { reactive } from "vue";

// Props for existing files (from backend)
const props = defineProps({
  initialLebenslauf: Object,
  initialQualifikationen: Array,
  initialAuszeichnungen: Array,
  initialSonstiges: Array
});

// Reactive state
const lebenslauf = reactive(props.initialLebenslauf || null);
const qualifikation = reactive(props.initialQualifikationen.length ? [...props.initialQualifikationen] : [null]);
const auszeichnung = reactive(props.initialAuszeichnungen.length ? [...props.initialAuszeichnungen] : [null]);
const sonstiges = reactive(props.initialSonstiges.length ? [...props.initialSonstiges] : [null]);

function addRow(type) {
  if (type === "qualifikation") qualifikation.push(null);
  if (type === "auszeichnung") auszeichnung.push(null);
  if (type === "sonstiges") sonstiges.push(null);
}

function removeRow(type) {
  if (type === "qualifikation" && qualifikation.length > 1) qualifikation.pop();
  if (type === "auszeichnung" && auszeichnung.length > 1) auszeichnung.pop();
  if (type === "sonstiges" && sonstiges.length > 1) sonstiges.pop();
}

function handleFile(event, type, index = null) {
  const file = event.target.files[0];
  if (type === "lebenslauf") {
    lebenslauf.file = file;
  } else if (type === "qualifikation") {
    qualifikation[index] = file;
  } else if (type === "auszeichnung") {
    auszeichnung[index] = file;
  } else if (type === "sonstiges") {
    sonstiges[index] = file;
  }
}

function formatDate(date) {
  if (!date) return "";
  const d = new Date(date);
  return `${d.getDate().toString().padStart(2,'0')}.${(d.getMonth()+1).toString().padStart(2,'0')}.${d.getFullYear()}`;
}

function submitForm() {
  const formData = new FormData();
  if (lebenslauf?.file) formData.append("lebenslauf", lebenslauf.file);

  qualifikation.forEach((f, i) => f && formData.append("qualifikation[]", f));
  auszeichnung.forEach((f, i) => f && formData.append("auszeichnung[]", f));
  sonstiges.forEach((f, i) => f && formData.append("sonstiges[]", f));

  // Replace with axios or fetch POST
  console.log("Submitting form with files:", formData);
}
</script>
