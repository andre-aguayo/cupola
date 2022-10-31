import axios from "axios";

export const apiSendMail = async (values) => await axios.post('/api/sendMail', { ...values });