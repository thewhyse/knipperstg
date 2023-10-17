<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Field: backup
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! class_exists( 'KPSHG_Field_backup' ) ) {
  class KPSHG_Field_backup extends KPSHG_Fields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

      $unique = $this->unique;
      $nonce  = wp_create_nonce( 'kpshg_backup_nonce' );
      $export = add_query_arg( array( 'action' => 'kpshg-export', 'unique' => $unique, 'nonce' => $nonce ), admin_url( 'admin-ajax.php' ) );

      echo $this->field_before();

      echo '<textarea name="kpshg_import_data" class="kpshg-import-data"></textarea>';
      echo '<button type="submit" class="button button-primary kpshg-confirm kpshg-import" data-unique="'. esc_attr( $unique ) .'" data-nonce="'. esc_attr( $nonce ) .'">'. esc_html__( 'Import', 'kpshg' ) .'</button>';
      echo '<hr />';
      echo '<textarea readonly="readonly" class="kpshg-export-data">'. esc_attr( json_encode( get_option( $unique ) ) ) .'</textarea>';
      echo '<a href="'. esc_url( $export ) .'" class="button button-primary kpshg-export" target="_blank">'. esc_html__( 'Export & Download', 'kpshg' ) .'</a>';
      echo '<hr />';
      echo '<button type="submit" name="kpshg_transient[reset]" value="reset" class="button kpshg-warning-primary kpshg-confirm kpshg-reset" data-unique="'. esc_attr( $unique ) .'" data-nonce="'. esc_attr( $nonce ) .'">'. esc_html__( 'Reset', 'kpshg' ) .'</button>';

      echo $this->field_after();

    }

  }
}
