export const translations = {
    methods: {
        __(key, replacements = {}) {
            let translation = TRANSLATIONS._translations[key] || key;

            Object.keys(replacements).forEach( replacement =>{
                translation = translation.replace(`:${replacement}`, replacements[replacement]);
            });

            return translation;
        },
    },
};
