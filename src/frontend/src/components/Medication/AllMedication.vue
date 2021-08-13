<template>
  <div>
    <div class="row">
      <div class="col-12">
        <div v-for="data in medications" :key="data.id" class="row">
          <div class="col-12">
            <div class="tw-flex tw-justify-between tw-items-center">
              <div class="tw-text-lg tw-mx-2">{{ data.drug }}</div>
              <div
                class="tw-py-1 tw-px-2 tw-mx-2 tw-shadow-md tw-no-underline tw-rounded-full tw-bg-blue-600 tw-text-white tw-font-sans tw-font-medium tw-text-xs"
              >{{ data.dosage }} dosage / day for {{ data.duration }} days</div>
              <div
                class="tw-py-1 tw-px-2 tw-mx-2 tw-shadow-md tw-no-underline tw-rounded-full tw-bg-red-600 tw-text-white tw-font-sans tw-font-medium tw-text-xs"
              >{{ data.qty }}</div>
              <div
                class="tw-py-1 tw-px-2 tw-mx-2 tw-shadow-md tw-no-underline tw-rounded-full tw-bg-teal-600 tw-text-white tw-font-sans tw-font-medium tw-text-xs"
              >{{ data.type }}</div>
              <slot v-bind:id="data.id"></slot>
            </div>
          </div>
          <hr style="width:98%" />
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ['medications'],
}
</script>