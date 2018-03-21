package it.tissino.em;

/**
 * Represents a Basic Encryption Manager, able to do nearly nothing.
 */
public class EncryptionManager {

    // ------------- attributes --------------

    static private int _count;

    // -------- getters and setters ----------

    public EncryptionManager()
    {
        //System.out.println("I have been created! " + Integer.toHexString(hashCode()));
        _count += 1;
    }

    public static int getCount()
    {
        return _count;
    }

    /**
     * Gets the cypher used.
     * @return the cypher used.
     */
    public String getCypher()
    {
        return "NULL";
    }


    // --------- public methods -----------

    /**
     * Decrypts a message with the current set cypher.
     * @param msg the message to decrypt
     * @return the message decrypted.
     */
    public  String decrypt(String msg) {
        return msg;  // TODO invalid chars could be taken away...
    }

    /**
     * Encrypts a message with the current set cypher.
     * @param msg the message to encrypt
     * @return the message encrypted.
     */
    public String encrypt(String msg) {
        return msg;
    }

    /**
     * Sets initial static values for the class
     */
    static
    {
        _count = 0;
    }

    /**
     * Runs final actions before definitive deletion.
     * Directly called by the garbage collector.
     */
    public void finalize()
    {
        System.out.println("I have been destroyed!" +  hashCode());
        _count--;
        System.out.println("Count now is: " + _count);
    }

    //override
    public String toString()
    {
        return "I am an encryption manager of type: "+ getCypher();
    }

}
