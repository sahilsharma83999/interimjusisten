<template>
  <form @submit.prevent="submitForm">
    <h1>Max. Verantwortung in einer Firma <small>Schritt 6 von 8</small></h1>

    <!-- Personalverantwortung -->
    <h2 class="button-align-6">
      Personalverantwortung
      <button type="button" class="btn btn-success" @click="addRow(personal)">
        <i class="fa fa-plus"></i>
      </button>
      <button type="button" class="btn btn-danger" @click="removeRow(personal)">
        <i class="fa fa-minus"></i>
      </button>
    </h2>
    <div v-for="(p, index) in personal" :key="'personal-'+index" class="form-group row">
      <div class="col-lg-4">
        <select v-model="p.amount" :name="`personal[${index}][amount]`" class="form-control">
          <option v-for="(label, key) in vData.amountPersonal" :key="key" :value="key">{{ label }}</option>
        </select>
      </div>
      <div class="col-lg-4">
        <select v-model="p.period" :name="`personal[${index}][period]`" class="form-control">
          <option v-for="(label, key) in vData.periodPersonal" :key="key" :value="key">{{ label }}</option>
        </select>
      </div>
    </div>

    <hr>

    <!-- Umsatzverantwortung -->
    <h2 class="button-align-6">
      Umsatzverantwortung
      <button type="button" class="btn btn-success" @click="addRow(umsatz)">
        <i class="fa fa-plus"></i>
      </button>
      <button type="button" class="btn btn-danger" @click="removeRow(umsatz)">
        <i class="fa fa-minus"></i>
      </button>
    </h2>
    <div v-for="(u, index) in umsatz" :key="'umsatz-'+index" class="form-group row">
      <div class="col-lg-4">
        <select v-model="u.amount" :name="`umsatz[${index}][amount]`" class="form-control" required>
          <option v-for="(label, key) in vData.amountUmsatz" :key="key" :value="key">{{ label }}</option>
        </select>
      </div>
      <div class="col-lg-4">
        <select v-model="u.period" :name="`umsatz[${index}][period]`" class="form-control" required>
          <option v-for="(label, key) in vData.periodUmsatz" :key="key" :value="key">{{ label }}</option>
        </select>
      </div>
    </div>

    <hr>

    <!-- Budgetverantwortung -->
    <h2 class="button-align-6">
      Budgetverantwortung
      <button type="button" class="btn btn-success" @click="addRow(budget)">
        <i class="fa fa-plus"></i>
      </button>
      <button type="button" class="btn btn-danger" @click="removeRow(budget)">
        <i class="fa fa-minus"></i>
      </button>
    </h2>
    <div v-for="(b, index) in budget" :key="'budget-'+index" class="form-group row">
      <div class="col-lg-4">
        <select v-model="b.amount" :name="`budget[${index}][amount]`" class="form-control">
          <option v-for="(label, key) in vData.amountBudget" :key="key" :value="key">{{ label }}</option>
        </select>
      </div>
      <div class="col-lg-4">
        <select v-model="b.period" :name="`budget[${index}][period]`" class="form-control">
          <option v-for="(label, key) in vData.periodBudget" :key="key" :value="key">{{ label }}</option>
        </select>
      </div>
    </div>

    <hr>

    <!-- Einkaufsverantwortung -->
    <h2 class="button-align-6">
      Einkaufsverantwortung
      <button type="button" class="btn btn-success" @click="addRow(einkauf)">
        <i class="fa fa-plus"></i>
      </button>
      <button type="button" class="btn btn-danger" @click="removeRow(einkauf)">
        <i class="fa fa-minus"></i>
      </button>
    </h2>
    <div v-for="(e, index) in einkauf" :key="'einkauf-'+index" class="form-group row">
      <div class="col-lg-4">
        <select v-model="e.amount" :name="`einkauf[${index}][amount]`" class="form-control">
          <option v-for="(label, key) in vData.amountEinkauf" :key="key" :value="key">{{ label }}</option>
        </select>
      </div>
      <div class="col-lg-4">
        <select v-model="e.period" :name="`einkauf[${index}][period]`" class="form-control">
          <option v-for="(label, key) in vData.periodEinkauf" :key="key" :value="key">{{ label }}</option>
        </select>
      </div>
    </div>

    <button type="submit" class="btn btn-lg btn-primary">Speichern</button>
  </form>
</template>

<script setup>
import { reactive } from 'vue';

// Props: vData contains all options from backend
const props = defineProps({
  vData: { type: Object, required: true },
  initialPersonal: { type: Array, default: () => [{}] },
  initialUmsatz: { type: Array, default: () => [{}] },
  initialBudget: { type: Array, default: () => [{}] },
  initialEinkauf: { type: Array, default: () => [{}] },
});

// Reactive arrays
const personal = reactive(props.initialPersonal)
const umsatz = reactive(props.initialUmsatz)
const budget = reactive(props.initialBudget)
const einkauf = reactive(props.initialEinkauf)

// Generic add/remove functions
function addRow(list) { list.push({ amount: '', period: '' }) }
function removeRow(list) { if(list.length > 1) list.pop() }

// Submit handler
function submitForm() {
  const formData = new FormData()
  personal.forEach((p, i) => { formData.append(`personal[${i}][amount]`, p.amount); formData.append(`personal[${i}][period]`, p.period) })
  umsatz.forEach((u, i) => { formData.append(`umsatz[${i}][amount]`, u.amount); formData.append(`umsatz[${i}][period]`, u.period) })
  budget.forEach((b, i) => { formData.append(`budget[${i}][amount]`, b.amount); formData.append(`budget[${i}][period]`, b.period) })
  einkauf.forEach((e, i) => { formData.append(`einkauf[${i}][amount]`, e.amount); formData.append(`einkauf[${i}][period]`, e.period) })

  console.log('Submitting Verantwortung form', Object.fromEntries(formData.entries()))
  // axios.post('/account/verantwortung', formData) can be used here
}
</script>
