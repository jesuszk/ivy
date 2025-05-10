const segments = window.location.pathname.split("/").filter(Boolean); // remove vazios
const basePath = `/${segments.slice(0, 3).join("/")}`; // pega os 3 primeiros níveis
const APP_URL = `${window.location.protocol}//${window.location.host}${basePath}`;

//ROTAS
const ROUTE_UPLOADS_SAVE = `${APP_URL}/uploads/save`;
const ROUTE_UPLOADS_UPDATE = `${APP_URL}/uploads/update`;

//ETAPAS
const ETAPAS_VENDAS_ALINHAMENTO = "Vendas Alinhamento";

//VARS
const V_RODAS = "Rodas";
const V_FERROVIARIO = "Ferroviário";
const V_INDUSTRIAL = "Industrial";

/**
 * Responsible for obtaining Query String parameters
 * @returns {object} - Params of url
 */
function getQuery() {
  var params = {};
  var queryString = window.location.search.substring(1);

  if (queryString) {
    var queries = queryString.split("&");
    queries.forEach(function (query) {
      var parts = query.split("=");
      params[decodeURIComponent(parts[0])] = decodeURIComponent(parts[1] || "");
    });
  }
  return params;
}

/**
 * Responsible for obtaining an element by ID
 * @param {String} id
 * @returns object - Params of url
 */
function getElement(inputId) {
  let input = document.getElementById(inputId);
  if (input) return input;
  return false;
}

/**
 * This method aims to set the value of a field through the ID
 * @param {String} id
 * @param {*} value
 * @return {true|false}
 */
function setValueById(id, value) {
  if ((element = document.getElementById(id))) {
    element.value = value;
    return true;
  }
  return false;
}

async function getPage(url) {
  try {
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error("Network response was not ok");
    }
    const data = await response.text();
    return data;
  } catch (error) {
    console.error("Houve um problema ao tentar buscar o arquivo:", error);
    return null;
  }
}

const tooltipTriggerList = document.querySelectorAll(
  '[data-bs-toggle="tooltip"]'
);
const tooltipList = [...tooltipTriggerList].map(
  (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
);

function hiddenElement(elm) {
  elm.classList.add("d-none");
}

function showElement(elm) {
  elm.classList.remove("d-none");
}
