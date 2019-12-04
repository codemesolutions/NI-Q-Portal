<?php
namespace FedEx\RateService\SimpleType;

use FedEx\AbstractSimpleType;

/**
 * Type of documents that are recommended to be included with the shipment.
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Rate Service
 */
class RecommendedDocumentType extends AbstractSimpleType
{
    const _ANTIQUE_STATEMENT_EUROPEAN_UNION = 'ANTIQUE_STATEMENT_EUROPEAN_UNION';
    const _ANTIQUE_STATEMENT_UNITED_STATES = 'ANTIQUE_STATEMENT_UNITED_STATES';
    const _ASSEMBLER_DECLARATION = 'ASSEMBLER_DECLARATION';
    const _BEARING_WORKSHEET = 'BEARING_WORKSHEET';
    const _CERTIFICATE_OF_SHIPMENTS_TO_SYRIA = 'CERTIFICATE_OF_SHIPMENTS_TO_SYRIA';
    const _COMMERCIAL_INVOICE_FOR_THE_CARIBBEAN_COMMON_MARKET = 'COMMERCIAL_INVOICE_FOR_THE_CARIBBEAN_COMMON_MARKET';
    const _CONIFEROUS_SOLID_WOOD_PACKAGING_MATERIAL_TO_THE_PEOPLES_REPUBLIC_OF_CHINA = 'CONIFEROUS_SOLID_WOOD_PACKAGING_MATERIAL_TO_THE_PEOPLES_REPUBLIC_OF_CHINA';
    const _DECLARATION_FOR_FREE_ENTRY_OF_RETURNED_AMERICAN_PRODUCTS = 'DECLARATION_FOR_FREE_ENTRY_OF_RETURNED_AMERICAN_PRODUCTS';
    const _DECLARATION_OF_BIOLOGICAL_STANDARDS = 'DECLARATION_OF_BIOLOGICAL_STANDARDS';
    const _DECLARATION_OF_IMPORTED_ELECTRONIC_PRODUCTS_SUBJECT_TO_RADIATION_CONTROL_STANDARD = 'DECLARATION_OF_IMPORTED_ELECTRONIC_PRODUCTS_SUBJECT_TO_RADIATION_CONTROL_STANDARD';
    const _ELECTRONIC_INTEGRATED_CIRCUIT_WORKSHEET = 'ELECTRONIC_INTEGRATED_CIRCUIT_WORKSHEET';
    const _FILM_AND_VIDEO_CERTIFICATE = 'FILM_AND_VIDEO_CERTIFICATE';
    const _INTERIM_FOOTWEAR_INVOICE = 'INTERIM_FOOTWEAR_INVOICE';
    const _NAFTA_CERTIFICATE_OF_ORIGIN_CANADA_ENGLISH = 'NAFTA_CERTIFICATE_OF_ORIGIN_CANADA_ENGLISH';
    const _NAFTA_CERTIFICATE_OF_ORIGIN_CANADA_FRENCH = 'NAFTA_CERTIFICATE_OF_ORIGIN_CANADA_FRENCH';
    const _NAFTA_CERTIFICATE_OF_ORIGIN_SPANISH = 'NAFTA_CERTIFICATE_OF_ORIGIN_SPANISH';
    const _NAFTA_CERTIFICATE_OF_ORIGIN_UNITED_STATES = 'NAFTA_CERTIFICATE_OF_ORIGIN_UNITED_STATES';
    const _PACKING_LIST = 'PACKING_LIST';
    const _PRINTED_CIRCUIT_BOARD_WORKSHEET = 'PRINTED_CIRCUIT_BOARD_WORKSHEET';
    const _REPAIRED_WATCH_BREAKOUT_WORKSHEET = 'REPAIRED_WATCH_BREAKOUT_WORKSHEET';
    const _STATEMENT_REGARDING_THE_IMPORT_OF_RADIO_FREQUENCY_DEVICES = 'STATEMENT_REGARDING_THE_IMPORT_OF_RADIO_FREQUENCY_DEVICES';
    const _TOXIC_SUBSTANCES_CONTROL_ACT = 'TOXIC_SUBSTANCES_CONTROL_ACT';
    const _UNITED_STATES_CARIBBEAN_BASIN_TRADE_PARTNERSHIP_ACT_CERTIFICATE_OF_ORIGIN_NON_TEXTILES = 'UNITED_STATES_CARIBBEAN_BASIN_TRADE_PARTNERSHIP_ACT_CERTIFICATE_OF_ORIGIN_NON_TEXTILES';
    const _UNITED_STATES_CARIBBEAN_BASIN_TRADE_PARTNERSHIP_ACT_CERTIFICATE_OF_ORIGIN_TEXTILES = 'UNITED_STATES_CARIBBEAN_BASIN_TRADE_PARTNERSHIP_ACT_CERTIFICATE_OF_ORIGIN_TEXTILES';
    const _UNITED_STATES_NEW_WATCH_WORKSHEET = 'UNITED_STATES_NEW_WATCH_WORKSHEET';
    const _UNITED_STATES_WATCH_REPAIR_DECLARATION = 'UNITED_STATES_WATCH_REPAIR_DECLARATION';
}
