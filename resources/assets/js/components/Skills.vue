<template>
  <form @submit.prevent="submitForm">
    <h2>
      Persönliche Eigenschaften und Interessen 
      <small>Schritt 5 von 8</small>
      <button type="button" class="btn btn-success" @click="addRow" :disabled="models.length >= 4">
        <i class="fa fa-plus"></i>
      </button>
      <button type="button" class="btn btn-danger" @click="removeRow">
        <i class="fa fa-minus"></i>
      </button>
      <br>
      <small>Vier Nennungen sind möglich</small>
    </h2>

    <div v-for="(model, index) in models" :key="index" class="form-group row">
      <div class="col-lg-4">
        <select class="form-control" v-model="model.skill" :name="`skills[]`">
          <option v-for="(label, key) in skillsList" :key="key" :value="key">{{ label }}</option>
        </select>
      </div>
    </div>

    <hr>
    <h2>Selbsteinschätzung &amp; Dritteinschätzung</h2>
    <div class="form-group">
      <textarea v-model="selfEvaluation" name="self_evaluation" cols="30" rows="10" class="form-control"></textarea>
    </div>

    <button type="submit" class="btn btn-lg btn-primary">Speichern</button>
  </form>
</template>

<script setup>
import { reactive, ref } from 'vue';

// Props: initial selected skills & skill options from backend
const props = defineProps({
  initialSkills: { type: Array, default: () => [] },
  skillsList: { type: Object, default: () => ({}) },
  initialSelfEvaluation: { type: String, default: '' }
});

// Reactive models for dynamic rows
const models = reactive(props.initialSkills.length ? props.initialSkills.map(s => ({ skill: s })) : [{ skill: '' }]);

// Self-evaluation text
const selfEvaluation = ref(props.initialSelfEvaluation);

// Add/remove row functions
function addRow() {
  if (models.length < 4) models.push({ skill: '' });
}

function removeRow() {
  if (models.length > 1) models.pop();
}

// Submit handler
function submitForm() {
  const formData = new FormData();
  models.forEach(m => formData.append('skills[]', m.skill));
  formData.append('self_evaluation', selfEvaluation.value);

  console.log('Submitting Faehigkeiten form', Object.fromEntries(formData.entries()));
  // axios.post('/account/faehigkeiten', formData) can be used here
}
</script>
