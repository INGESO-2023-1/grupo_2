<template>
  <div>
    <div
      class="bg-white text-opacity-80 text-black shadow
    dark:bg-gray-800 dark:text-opacity-80 dark:text-white
      dark:shadow-none rounded-lg {$padding} flex flex-col gap-2 rounded p-6"
    >
      <div
        v-for="message in chat.messages"
        :key="message.id"
        :class="`bg-gray-100 dark:bg-gray-700 p-3 rounded-lg flex flex-shrink
          ${message.senderId == userId ? 'self-end' : 'self-start'}`"
      >
        {{ message.content }}
      </div>
      <div class="flex mt-3 gap-3">
        <input
          v-model="message"
          type="text"
          placeholder="mensaje"
          class="rounded-lg p-3 w-full
                focus:border-blue-500 focus:border-2 focus:ring-0
                disabled:text-opacity-60 disabled:text-white
                border-black border-opacity-20 border-1
                dark:border-white dark:border-opacity-10 dark:border-1
                bg-dark bg-opacity-10
                dark:bg-black dark:bg-opacity-30"
          @keyup.enter="sendMessage()"
        >
        <button
          type="button"
          class="p-3 rounded-lg flex items-center justify-center bg-blue-800 text-white"
          @click="sendMessage()"
        >
          enviar
        </button>
      </div>
    </div>
  </div>
</template>
<script>

import chatsApi from '../api/chat';

export default {
  props: {
    chatId: {
      type: Number,
      required: true,
    },
    userId: {
      type: Number,
      required: true,
    },
  },
  data() {
    return {
      chat: {},
      message:'',
      lastCheck: null,
      checkTimeout: null,
    };
  },
  mounted() {
    this.fetchChat();
  },
  methods: {
    async fetchChat() {
      this.chat = (await chatsApi.getMessages(this.chatId)).data;
      this.lastCheck = new Date();

      clearTimeout(this.checkTimeout);

      this.checkTimeout = setInterval(() => {
        this.fetchChat();
      }, 1000);
    },
    async sendMessage() {
      await chatsApi.sendMessage(this.chatId, {content: this.message});
      this.message = '';
      this.fetchChat();
    },
  },
};
</script>
