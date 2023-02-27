import ru from '@/Locales/ru.json';
import en from '@/Locales/en.json';

const locales = {
    'ru-RU': ru,
    'en-US': en
}

 export default function localizeFilter(key, lang) {
        return locales[lang][key] || `[Localize error]: key ${key} not found`;
    }

