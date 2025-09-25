<template>
  <form @submit.prevent="submitForm">
    <h1>Berufliche Schwerpunkte <small>Schritt 7 von 8</small></h1>
    <hr>

    <h3>Wählen Sie 5 Kernkompetenzen aus</h3>
    <div class="well">
      Gewichten Sie Ihre Kompetenzfelder:<br>
      Platz 1 = Hauptkompetenz, Platz 2 = zweitgrößte Kompetenz u.s.w.<br>
      Bitte geben Sie Ihre speziellen Kenntnisse an und ordnen Sie der zutreffenden Erfahrungsstufe zu:
    </div>

    <div v-for="(comp, index) in kompetenzList" :key="index" class="row well">
      <div class="col-lg-4">
        <select v-model="comp.level1.selected" :name="`kompetenz[${comp.key}][level1]`" class="form-control">
          <option v-for="option in comp.level1.options" :key="option.value" :value="option.value">{{ option.label }}</option>
        </select>
      </div>
      <div class="col-lg-4">
        <select v-model="comp.level2.selected" :name="`kompetenz[${comp.key}][level2]`" class="form-control" :disabled="!comp.level2.options.length">
          <option v-for="option in comp.level2.options" :key="option.value" :value="option.value">{{ option.label }}</option>
        </select>
      </div>
      <div class="col-lg-4">
        <select v-model="comp.level3.selected" :name="`kompetenz[${comp.key}][level3]`" class="form-control" :disabled="!comp.level3.options.length">
          <option v-for="option in comp.level3.options" :key="option.value" :value="option.value">{{ option.label }}</option>
        </select>
      </div>
    </div>

    <hr>

    <h3>Wählen Sie 3 Bereiche aus, in dem das Unternehmen Ihr Headquarter hat.</h3>
    <div class="form-group row">
      <div class="col-lg-4" v-for="i in 3" :key="'schwerpunkt-'+i">
        <select :name="`schwerpunkt[${i-1}]`" class="form-control" v-model="schwerpunkte[i-1]" required>
          <option v-for="(label, key) in availableSchwerpunkte" :key="key" :value="key">{{ label }}</option>
        </select>
      </div>
    </div>

    <hr>

    <h3>Berufsverhältnis gewünscht als</h3>
    <div class="form-group row">
      <div class="col-lg-4" v-for="(type, key) in employmentTypes" :key="key">
        <div class="input-group">
          <span class="input-group-addon">
            <input type="checkbox" v-model="employmentTypes[key]" :id="key">
          </span>
          <div class="form-control">{{ type.label }}</div>
        </div>
      </div>
    </div>

    <div class="form-group">
      <input type="submit" class="btn btn-lg btn-primary" value="Speichern">
    </div>
  </form>
</template>

<script setup>
import { reactive } from 'vue';
import { computed } from 'vue';

// Props
const props = defineProps({
  initialKompetenzen: { type: Object, required: true }, // structure: first, second, third, fourth, fifth
  availableSchwerpunkte: { type: Object, required: true }, // key => label
  initialSchwerpunkte: { type: Array, default: () => ['', '', ''] },
  userEmployment: { type: Object, default: () => ({ festanstellung: false, interimManger: false, managementBuyIn: false }) },
});

// Reactive state
const kompetenzList = reactive([
  { key: 'first', ...props.initialKompetenzen.first },
  { key: 'second', ...props.initialKompetenzen.second },
  { key: 'third', ...props.initialKompetenzen.third },
  { key: 'fourth', ...props.initialKompetenzen.fourth },
  { key: 'fifth', ...props.initialKompetenzen.fifth },
]);

const schwerpunkte = reactive([...props.initialSchwerpunkte]);

const employmentTypes = reactive({
  festanstellung: props.userEmployment.festanstellung,
  interimManger: props.userEmployment.interimManger,
  managementBuyIn: props.userEmployment.managementBuyIn,
});

// Submit function
function submitForm() {
  const formData = new FormData();

  // Kompetenzen
  kompetenzList.forEach(comp => {
    formData.append(`kompetenz[${comp.key}][level1]`, comp.level1.selected || '');
    formData.append(`kompetenz[${comp.key}][level2]`, comp.level2.selected || '');
    formData.append(`kompetenz[${comp.key}][level3]`, comp.level3.selected || '');
  });

  // Schwerpunkte
  schwerpunkte.forEach((val, i) => {
    formData.append(`schwerpunkt[${i}]`, val);
  });

  // Employment Types
  Object.keys(employmentTypes).forEach(key => {
    formData.append(key, employmentTypes[key] ? 1 : 0);
  });

  console.log('Form submission:', Object.fromEntries(formData.entries()));
  // axios.post('/account/schwerpunkte', formData) can be used here
}
</script>
