<template>
  <div class="autocomplete">
    <div class="row">
      <div :class="column">
        <input
          ref="code"
          type="text"
          class="form-control"
          v-model="search"
          @input="onChange"
          @keyup.down="onArrowDown"
          @keyup.up="onArrowUp"
          @keyup.enter="onEnter"
          :placeholder="placeholder"
        />
      </div>
      <div class="col-md-2" v-show="isCode & isBP">
        <input ref="value" type="text" class="form-control" v-model="value" />
      </div>
      <div class="col-md-2" v-show="isCode">
        <input type="text" class="form-control" @keyup.enter="onRangeEnter" v-model="range" />
      </div>
      <div :class="column">
        <ul class="autocomplete-results" v-show="isOpen && results.length != 0">
          <li
            v-for="(result, i) in results"
            :key="i"
            class="autocomplete-result"
            @click="setResult(i)"
            :class="{ 'is-active': i === arrowCounter }"
          >
            <span class="autocomplete--option">{{ result }}</span>
          </li>
        </ul>
      </div>
    </div>
    <div class="row p-3">
      <div class="col-12 text-center">
        <button
          @click="saveExamination()"
          type="button"
          class="btn btn-info waves-effect waves-light m-r-10"
        >Save</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'AutoComplete',
  props: {
    items: {
      type: Array,
      required: false,
      default: () => [],
    },
    placeholder: {
      type: String,
      required: true,
      default: () => 'Type to search',
    },
  },
  data() {
    return {
      search: '',
      results: [],
      isOpen: false,
      isCode: false,
      arrowCounter: -1,
      value: '',
      range: '',
    }
  },
  computed: {
    column() {
      return this.isCode ? 'col-md-8' : 'col-md-12'
    },
    isBP() {
      return this.search.includes('(BP)')
    },
  },
  methods: {
    resetSearch() {
      this.search = ''
      this.value = ''
      this.range = ''
      this.isOpen = false
      this.isCode = false
      this.arrowCounter = -1
      this.$nextTick(function() {
        this.$refs.code.focus()
      })
    },
    onChange() {
      this.isOpen = true
      this.filterResults()
    },
    filterResults() {
      this.results = this.items.filter(
        item => item.toLowerCase().indexOf(this.search.toLowerCase()) > -1
      )
    },
    setResult(i) {
      this.search = this.results[i]
      this.isCode = true
      this.isOpen = false
      this.arrowCounter = -1
      this.$nextTick(function() {
        this.$refs.value.focus()
      })
    },
    onArrowDown() {
      if (this.arrowCounter < this.results.length) {
        let acitve_lists = document.getElementsByClassName('autocomplete-result is-active')
        if (acitve_lists.length > 0) {
          acitve_lists[0].scrollIntoView({
            behavior: 'smooth',
            block: 'nearest',
            inline: 'start',
          })
        }
        this.arrowCounter = this.arrowCounter + 1
      }
    },
    onArrowUp() {
      if (this.arrowCounter > 0) {
        let acitve_lists = document.getElementsByClassName('autocomplete-result is-active')
        if (acitve_lists.length > 0) {
          acitve_lists[0].scrollIntoView(true)
        }
        this.arrowCounter = this.arrowCounter - 1
      }
    },
    onEnter() {
      if (this.results[this.arrowCounter]) {
        this.search = this.results[this.arrowCounter]
        this.isCode = true
        this.isOpen = false
        this.arrowCounter = -1
        this.$nextTick(function() {
          this.$refs.value.focus()
        })
      } else {
        this.isOpen = false
        this.arrowCounter = -1
        this.$emit('select-event', this.search)
        this.resetSearch()
        this.$nextTick(function() {
          this.$refs.value.focus()
        })
      }
    },
    onRangeEnter() {
      let unit = this.checkRange(this.search)
      this.search = `${this.search} reading ${this.value}/${this.range} ${unit}`
      this.$emit('select-event', this.search)
      this.resetSearch()
    },
    checkRange(value) {
      if (value.includes('(BP)')) {
        return 'mmHg'
      } else if (value.includes('O/E - Height')) {
        return 'cm'
      } else if (value.includes('weight')) {
        return 'kg'
      } else if (value.includes('44YA')) {
        return '%'
      } else if (value.includes('3395')) {
        return 'L/min'
      } else if (value.includes('O/E - pulse rate')) {
        return 'beats/min'
      } else if (value.includes('smoker')) {
        return 'box'
      } else if (value.includes('Alcohol consumption')) {
        return 'U/week'
      } else {
        return ''
      }
    },
    saveExamination() {
      let unit = this.checkRange(this.search)
      this.search = `${this.search} reading ${this.value}/${this.range} ${unit}`
      this.$emit('select-event', this.search)
    },
  },
  mounted() {
    this.$refs.code.focus()
  },
}
</script>

<style>
.autocomplete {
  position: relative;
}

.autocomplete-results {
  padding: 0;
  margin: 0;
  border: 1px solid #e9ecef;
  max-height: 300px;
  overflow: auto;
  border-radius: 0.25rem;
}

.autocomplete-result {
  list-style: none;
  text-align: left;
  padding: 4px 2px;
  cursor: pointer;
}

.autocomplete-result:hover {
  background-color: #4aae9b;
  color: white;
}

.autocomplete-result.is-active,
.autocomplete-result:hover {
  background-color: #4aae9b;
  color: white;
}

.autocomplete--option {
  display: block;
  padding: 12px;
  min-height: 40px;
  line-height: 16px;
  text-decoration: none;
  text-transform: none;
  vertical-align: middle;
  position: relative;
  cursor: pointer;
  white-space: nowrap;
}
</style>