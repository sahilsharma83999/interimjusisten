<template>
  <div class="admin-search">
    <!-- Top checkboxes -->
    <div class="row mb-3">
      <div class="col-lg-4" v-for="(label, key) in topCheckboxes" :key="key">
        <label class="form-check">
          <input type="checkbox" v-model="searchState[key]" class="form-check-input" />
          <span class="form-check-label">{{ label }}</span>
        </label>
      </div>
    </div>

    <hr />

    <!-- Dynamic Row Sections -->
    <RowSection
      v-for="(section, index) in dynamicSections"
      :key="index"
      :title="section.title"
      :items.sync="searchState[section.key]"
      :fields="section.fields"
      :options="section.options"
    />

    <hr />

    <!-- Columns visibility -->
    <div class="row mb-3">
      <div class="col-md-12">
        <label v-for="(value, key) in resultsView" :key="key" class="me-3">
          <input type="checkbox" v-model="resultsView[key]" />
          {{ key }}
        </label>
      </div>
    </div>

    <!-- Results -->
    <div v-if="results.length" class="mt-4">
      <div v-for="r in results" :key="r.id" class="card p-2 mb-2">
        <div class="row">
          <!-- Personal -->
          <div class="col-md-3" v-if="resultsView.personal">
            <strong>@{{ r.forename }} @{{ r.surname }}</strong><br />
            <a :href="`/admin/user/${r.id}`">@{{ r.email }}</a><br />
            @{{ r.title_gender }} @{{ r.title_graduation }}<br />
            @{{ r.street }} @{{ r.house_number }}<br />
            @{{ r.zipcode }} @{{ r.city }}<br />
            @{{ r.country }}<br />
            @{{ r.birthdateString }}<br />
            Mobil: @{{ r.mobil }} | Privat: @{{ r.phone_private }} |
            Gesch: @{{ r.phone_comercial }}
          </div>

          <div class="col-md-9">
            <!-- Auslandsprojekte -->
            <div v-if="resultsView.ausland && r.auslands_projekte">
              <strong>Auslandsprojekte:</strong>
              <div v-for="ap in r.auslands_projekte" :key="ap.id">
                @{{ ap.fromString }} - @{{ ap.toString }} (@{{ ap.brancheString }})
              </div>
            </div>

            <!-- Mandate -->
            <div v-if="resultsView.mandate && r.mandate">
              <strong>Mandate:</strong>
              <div v-for="m in r.mandate" :key="m.id">
                @{{ m.fromString }} - @{{ m.toString }} (@{{ m.brancheString }})<br />
                Umsatz: @{{ m.umsatz }}, MA: @{{ m.ma }}, Mitarbeiter: @{{ m.worker }}, Budget: @{{ m.budget }}
              </div>
            </div>

            <!-- Ausbildung & Karriere -->
            <div v-if="resultsView.ausbildung && r.karriere">
              <strong>Ausbildung & Karriere:</strong>
              <div v-for="k in r.karriere" :key="k.id">
                @{{ k.fromString }} - @{{ k.toString }};<br />
                <span v-if="k.type === 'ausbildung'">
                  A: @{{ k.fachrichtungString }}; @{{ k.spezialisierungString }}
                </span>
                <span v-else>
                  K: @{{ k.fachrichtungString }}; @{{ k.spezialisierungString }}
                </span>
              </div>
            </div>

            <!-- Fähigkeiten -->
            <div v-if="resultsView.skills && r.skills">
              <strong>Fähigkeiten:</strong>
              <div v-for="s in r.skills" :key="s.id">@{{ s.string }}</div>
            </div>

            <!-- Verantwortung -->
            <div v-if="resultsView.verantwortung && r.verantwortung">
              <strong>Verantwortung:</strong>
              <div v-for="v in r.verantwortung" :key="v.id">
                <span v-if="v.type === 'personal'">P; @{{ v.amountString }}; @{{ v.periodString }}</span>
                <span v-else-if="v.type === 'umsatz'">U; @{{ v.amountString }}; @{{ v.periodString }}</span>
                <span v-else-if="v.type === 'budget'">B; @{{ v.amountString }}; @{{ v.periodString }}</span>
                <span v-else-if="v.type === 'einkauf'">E; @{{ v.amountString }}; @{{ v.periodString }}</span>
              </div>
            </div>

            <!-- Schwerpunkte -->
            <div v-if="resultsView.kompetenz && r.kompetenz">
              <strong>Schwerpunkte:</strong>
              <div v-for="k in r.kompetenz" :key="k.id">@{{ k.string }}</div>
            </div>

            <!-- Dokumente -->
            <div v-if="r.dokumente">
              <strong>Dokumente:</strong>
              <div v-for="d in r.dokumente" :key="d.id">
                @{{ d.type }}:
                <a :href="`/download/${d.id}`" class="btn btn-xs btn-primary">
                  <i class="fa fa-download"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
const RowSection = {
  props: ["title", "items", "fields", "options"],
  emits: ["update:items"],
  template: `
  <div class="mb-3">
    <h6>{{ title }}</h6>
    <button type="button" class="btn btn-sm btn-success me-2" @click="addRow">+</button>
    <button type="button" class="btn btn-sm btn-danger" @click="removeRow">-</button>
    <div v-for="(item, index) in items" :key="index" class="row mt-2">
      <div v-for="field in fields" :key="field" class="col-md-2">
        <label>{{ field }}</label>
        <select v-if="options[field]" v-model="item[field]" class="form-control">
          <option v-for="(val, key) in options[field]" :key="key" :value="key">{{ val }}</option>
        </select>
        <input v-else type="text" v-model="item[field]" class="form-control"/>
      </div>
    </div>
  </div>
  `,
  methods: {
    addRow() {
      const newItem = {};
      this.fields.forEach((f) => (newItem[f] = ""));
      this.items.push(newItem);
      this.$emit("update:items", this.items);
    },
    removeRow() {
      if (this.items.length) this.items.pop();
      this.$emit("update:items", this.items);
    },
  },
};

export default {
  name: "AdminSearch",
  components: { RowSection },
  data() {
    return {
      topCheckboxes: {
        festanstellung: "Festanstellung",
        interim: "Interim Jurist",
        buyIn: "Management Buy In",
      },

      searchState: {
        festanstellung: true,
        interim: true,
        buyIn: true,
        auslandsProjekte: [],
        mandate: [],
        ausbildung: [],
        karriere: [],
        interessen: [],
        personalVerantwortung: [],
        umsatzVerantwortung: [],
        einkaufVerantwortung: [],
        budgetVerantwortung: [],
        schwerpunkte: [],
      },

      resultsView: {
        personal: true,
        ausland: true,
        mandate: true,
        ausbildung: true,
        skills: true,
        verantwortung: true,
        kompetenz: true,
      },

      results: [],

      dynamicSections: [
        {
          key: "auslandsProjekte",
          title: "Auslandsprojekte",
          fields: ["experience", "branche"],
          options: { experience: Array.from({ length: 97 }, (_, i) => i), branche: window.brancheOptions || {} },
        },
        {
          key: "mandate",
          title: "Mandate",
          fields: ["experience", "branche", "minUmsatz", "minMA", "minMit", "minBud"],
          options: { experience: Array.from({ length: 97 }, (_, i) => i), branche: window.brancheOptions || {} },
        },
        {
          key: "ausbildung",
          title: "Ausbildung",
          fields: ["experience", "ausbildung", "spezialisierung"],
          options: {
            experience: Array.from({ length: 97 }, (_, i) => i),
            ausbildung: window.ausbildungOptions || {},
            spezialisierung: window.spezialisierungOptions || {},
          },
        },
        {
          key: "karriere",
          title: "Karriere",
          fields: ["experience", "fachrichtung"],
          options: { experience: Array.from({ length: 97 }, (_, i) => i), fachrichtung: window.karriereOptions || {} },
        },
        {
          key: "interessen",
          title: "Fähigkeiten",
          fields: ["interesse"],
          options: { interesse: window.interesseOptions || {} },
        },
        {
          key: "personalVerantwortung",
          title: "Personal Verantwortung",
          fields: ["amount", "period"],
          options: { amount: window.personalAmountOptions || {}, period: window.personalPeriodOptions || {} },
        },
        {
          key: "umsatzVerantwortung",
          title: "Umsatz Verantwortung",
          fields: ["amount", "period"],
          options: { amount: window.umsatzAmountOptions || {}, period: window.umsatzPeriodOptions || {} },
        },
        {
          key: "einkaufVerantwortung",
          title: "Einkauf Verantwortung",
          fields: ["amount", "period"],
          options: { amount: window.einkaufAmountOptions || {}, period: window.einkaufPeriodOptions || {} },
        },
        {
          key: "budgetVerantwortung",
          title: "Budget Verantwortung",
          fields: ["amount", "period"],
          options: { amount: window.budgetAmountOptions || {}, period: window.budgetPeriodOptions || {} },
        },
        {
          key: "schwerpunkte",
          title: "Schwerpunkte",
          fields: ["selection"],
          options: { selection: window.kompetenzOptions || {} },
        },
      ],
    };
  },
};
</script>

<style scoped>
.card {
    background: #fff;
    border: 1px solid #e5e7eb;
}
.me-2 {
    margin-right: 0.5rem;
}
</style>