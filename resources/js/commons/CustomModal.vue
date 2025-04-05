<script setup>
import { computed, onMounted, onUnmounted, watch, ref } from 'vue';

const props = defineProps({
    show: {
        type: Boolean,
        default: false
    },
    maxWidth: {
        type: String,
        default: 'md'
    },
    closeable: {
        type: Boolean,
        default: true
    }
});

const emit = defineEmits(['close']);

watch(() => props.show, () => {
    if (props.show) {
      document.body.style.overflow = 'hidden';
    } else {
      document.body.style.overflow = 'visible';
    }
  }
);

const tryCloseModal = ref(false)

const close = () => {
  if (props.closeable) {
    emit('close');
  }

  launchAnimation()
}

const launchAnimation = () => tryCloseModal.value = true
const endAnimation = () => tryCloseModal.value = false

const closeOnEscape = (e) => {
    if (e.key === 'Escape' && props.show) {
        close();
    }
};

onMounted(() => document.addEventListener('keydown', closeOnEscape));

onUnmounted(() => {
    document.removeEventListener('keydown', closeOnEscape);
    document.body.style.overflow = 'visible';
});

const maxWidthClass = computed(() => {
  return {
    sm: 'sm:w-3/4 md:w-5/12 lg:w-3/9 xl:w-1/4',
    md: 'sm:w-9/12 md:w-8/12 lg:w-6/12',
    lg: 'sm:w-5/6 lg:w-4/6',
    xl: 'sm:w-11/12',
    'full': 'sm:w-full'
  }[props.maxWidth];
});

</script>

<template>
  <Teleport to="body">
    <Transition leave-active-class="duration-200">
      <div v-show="show" class="text-gray-300 container-modal fixed inset-0 overflow-y-auto  sm:px-0 z-50" scroll-region
        :class="{ 'dont-close': tryCloseModal, 'py-6 px-4': maxWidth !== 'full' }" @animationend="endAnimation">
        <Transition enter-active-class="ease-out duration-300" enter-from-class="opacity-0" enter-to-class="opacity-100"
          leave-active-class="ease-in duration-200" leave-from-class="opacity-100" leave-to-class="opacity-0">
          <div v-show="show" class="modal-background fixed inset-0 transform transition-all" @click="close">
            <div class="absolute inset-0 bg-gray-500 dark:bg-gray-900 opacity-75" />
          </div>
        </Transition>

        <Transition enter-active-class="ease-out duration-300"
          enter-from-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          enter-to-class="opacity-100 translate-y-0 sm:scale-100" leave-active-class="ease-in duration-200"
          leave-from-class="opacity-100 translate-y-0 sm:scale-100"
          leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
          <div v-show="show"
            class="mb-6 bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-xl transform transition-all mx-auto"
            :class="maxWidthClass">
            <slot />
          </div>
        </Transition>
      </div>
    </Transition>
  </Teleport>
</template>
<style scoped>
@keyframes crecerYVolver {
  0% {
    transform: scale(1);
  }

  50% {
    transform: scale(1.05);
  }

  100% {
    transform: scale(1);
  }
}

.dont-close {
  animation: crecerYVolver 0.35s ease-out;
}
</style>