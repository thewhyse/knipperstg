<?php


abstract class SocialSharing_Core_BaseModel extends RscSss_Mvc_Model implements RscSss_Environment_AwareInterface
{
    /**
     * @var RscSss_Environment
     */
    protected $environment;

    /**
     * Sets the environment.
     * @param RscSss_Environment $environment
     */
    public function setEnvironment(RscSss_Environment $environment)
    {
        $this->environment = $environment;
    }

    /**
     * Returns full database and vendor prefixes.
     * @return string
     */
    public function getPrefix()
    {
        if (!$this->environment) {
            throw new RuntimeException('Cannot get vendor prefix without app environment.');
        }

        $database = $this->db->prefix;
        $vendor = $this->environment->getConfig()->get('db_prefix');

        return $database.$vendor;
    }

    /**
     * Returns table name.
     * @param string|null $tableName Optional table name. Model name will be used if parameter is NULL.
     * @return string
     */
    public function getTable($tableName = null)
    {
        if (null === $tableName) {
            $classNameParts = explode('_', get_class($this));
            $tableName = strtolower(end($classNameParts));
        }

        return $this->getPrefix().$tableName;
    }

    /**
     * @param string|null $tableName
     * @param string $fieldName
     * @param string|null $as
     * @return string
     */
    public function getField($tableName = null, $fieldName = 'id', $as = null)
    {
        $field = sprintf('%s.%s', $this->getTable($tableName), $fieldName);

        if (is_string($as)) {
            $field = sprintf('%s AS %s', $field, $as);
        }

        return $field;
    }

    public function translate($string)
    {
        if ($this->environment) {
            return $this->environment->translate($string);
        }

        return $string;
    }

    protected function beforeValuesSet($fields) {
  		$values = array();

  		for($i = 0; $i < count($fields); $i++) {
  			$values[] = '%s';
  		}

  		return $values;
  	}
}
