<template>
  <div>
    <div class="row">
      <div class="col-lg-8">
        <h1>Suche</h1>
      </div>
      <div class="search-field">
        <div class="form-group">
          <div class="col-lg-1 search-group-label">
            <div class="row">
              <label for="search-group">Gruppe:</label>
            </div>
          </div>
          <div class="col-lg-3">
            <select
              class="form-control search-group"
              id="search-field"
              v-model="searchValue"
              @change="onSearchChange"
            >
              <option v-if="!selected" value="-10"></option>
              <option
                v-for="(fach, key) in careerGroups"
                :key="key"
                :value="fach.toLowerCase()"
              >
                {{ fach }}
              </option>
            </select>
          </div>
        </div>
      </div>
    </div>

    <hr />

    <div v-if="!results || results.length === 0" class="center">
      <h4>
        Wählen Sie eine Gruppe oben rechts, um einen Einblick in die vorhandenen
        Profile zu erhalten.
      </h4>
    </div>

    <div v-else>
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Jahre Erfahrung</th>
            <th>Kompetenzen</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="result in results" :key="result.id">
            <td>{{ result.id }}</td>
            <td>{{ result.anonymousName }}</td>
            <td>{{ result.yearsOfKarriere[selected] }}</td>
            <td>
              <div v-if="result.kompetenz && result.kompetenz.length">
                <div
                  v-for="(kompetenz, index) in result.kompetenz"
                  :key="index"
                >
                  <span
                    v-for="(value, key) in keyToNames(kompetenz.key)"
                    :key="key"
                  >
                    <span v-if="key !== 'level1'">-&gt;</span>{{ value }}
                  </span>
                  <br />
                </div>
              </div>
              <div v-else>
                Keine Angaben vorhanden
              </div>
            </td>
          </tr>
        </tbody>
      </table>
      <div style="text-align:right;">Gefunden: {{ results.length }}</div>
    </div>
</div>
  </template>

<script setup>
import { reactive, ref, watch } from 'vue';
import axios from 'axios';

// Props
const props = defineProps({
  careerGroups: { type: Object, required: true }, // e.g., App\Data\Fachrichtung::getKarriere()
  selected: { type: String, default: '' },
  initialResults: { type: Array, default: () => [] },
});

// Reactive state
const searchValue = ref(props.selected || '');
const results = reactive([...props.initialResults]);

// Example function to map keys to names (replace with API call if needed)
function keyToNames(key) {
  // Replace with real mapping like App\Data\KernKompetenz::keyToNames()
  return {
    level1: 'Hauptkompetenz',
    level2: 'Sekundärkompetenz',
    level3: 'Tertiärkompetenz',
  };
}

// Watch searchValue and fetch new results
async function onSearchChange() {
  if (!searchValue.value || searchValue.value === '-10') {
    results.length = 0;
    return;
  }

  try {
    const response = await axios.get(`/api/search?group=${searchValue.value}`);
    results.length = 0;
    response.data.forEach(r => results.push(r));
  } catch (err) {
    console.error('Search failed:', err);
    results.length = 0;
  }
}
</script>

<style scoped>
.center {
  text-align: center;
}
.search-field {
  margin-top: 15px;
  margin-bottom: 15px;
}
</style>
