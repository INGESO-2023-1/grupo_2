import api from './index';

export default {
  getMessages(chat, params) {
    return api({
      method: 'get',
      url: '/api/chats/' + chat,
      params,
    });
  },
  checkMessages(chat, params) {
    return api({
      method: 'get',
      url: '/api/chats/' + chat + '/check',
      params,
    });
  },
  sendMessage(chat, data) {
    return api({
      method: 'post',
      url: '/api/chats/' + chat + '/send',
      data,
    });
  },

};
