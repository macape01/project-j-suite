export class Messages {
    constructor(id, author_id, message, created, publicgroup_id, privateuser_id) {
      this.id = id;
      this.author_id = author_id;
      this.message = message;
      this.created = created;
      this.publicgroup_id = publicgroup_id;
      this.privateuser_id = privateuser_id;
    }
}