import axios from "axios";
import { isEmpty } from "lodash";

export const getProperties = async () => await axios.get('/api/home');

export const searchCompanies = async (search) => {
    if (search.name == '') {
        delete search.name;
    }

    if (search.UF == '') {
        delete search.UF;
    }

    if (search.city == '') {
        delete search.city;
    }

    if (!isEmpty(search)) {
        return await axios.get('/api/companies', {
            params: { ...search }
        });
    }

    return {};
};

export const getValidStateCities = async (UF) => await axios.get('api/state-cities?UF=' + UF);
