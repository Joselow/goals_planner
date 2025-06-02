<template>
  <Teleport to='body'>
    <div class="fixed top-5 start-6" style="z-index: 100;">
      <span class="loader"></span>
    </div>
  </Teleport>
</template>

<style scoped>
    .loader {
        width: 46px;
        height: 46px;
        border-radius: 50%;
        display: inline-block;
        border-top: 3px solid #FFF;
        border-right: 3px solid transparent;
        box-sizing: border-box;
        animation: rotation 1s linear infinite;
    }
    .loader::after {
        content: '';  
        box-sizing: border-box;
        position: absolute;
        left: 0;
        top: 0;
        width: 48px;
        height: 48px;
        border-radius: 50%;
        border-bottom: 3px solid #ff00d0;
        border-left: 4px solid transparent;
    }
    @keyframes rotation {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    } 
</style>